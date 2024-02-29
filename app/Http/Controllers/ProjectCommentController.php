<?php

namespace App\Http\Controllers;

use App\Models\AssignProject;
use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\ProjectCommentNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectCommentController extends Controller
{

    public function projectComments(Request $request, $p_id = null)
    {
        $search = $request->search;
        $project = Project::where('id', $p_id)->first();
        if (!$project) {
            abort(404);
        }

        $assignProjectsCustomer = AssignProject::with('assignby', 'customer', 'project')->where('project_id', $p_id)->get();

        // dd($assignProjectsCustomer->toArray());

        $projectComments = ProjectComment::with('project', 'commentBy')->where('project_id', $p_id);

        // dd($projectComments->toArray());

        if (!empty($search)) {
            if (Carbon::hasFormat($search, 'd-M-Y')) {
                $formattedDate = Carbon::createFromFormat('d-M-Y', $search)->format('Y-m-d');
                $projectComments->whereDate('created_at', $formattedDate);
            } else {
                $projectComments->where(function ($subquery) use ($search) {
                    $subquery->where('comment', 'like', '%' . $search . '%')
                        ->orWhereHas('commentBy', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('project', function ($customerQuery) use ($search) {
                            $customerQuery->where('project_name', 'like', '%' . $search . '%');
                        });
                });
            }
        }


        $projectComments = $projectComments->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.projectComment.comment', compact('projectComments', 'project', 'assignProjectsCustomer'));
    }


    // Add Project Comment view
    public function create($p_id)
    {
        $project = Project::find($p_id);
        return view('superadmin.projectComment.add', compact('project'));
    }


    // Store Project Comment

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required',
            'comment' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'project_id' => $request->project_id,
                'comment_by' => $request->comment_by,
                'comment' => $request->comment,
            ];

            $projectComment = ProjectComment::create($data);

            ProjectCommentNotification::create([
                'project_id' => $request->project_id,
                'notification_msg' => $request->comment,
                'status' => "unseen"
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Project Comment Added Successfully Done');
    }




    // Edit Comment
    public function edit(ProjectComment $comment)
    {
        $comment = ProjectComment::with('project')
            ->where('id', $comment->id)
            ->first();

            // dd($comment->toArray());
            return view('superadmin.projectComment.edit',compact('comment'));
        // return response()->json(['status' => 200, 'data' => $comment]);
    }

    // update Project Comment

    public function update(Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required',
            'comment' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $projectCommentsUpdate = ProjectComment::find($request->id);
            $data = [
                'project_id' => $request->project_id,
                'comment_by' => $request->comment_by,
                'comment' => $request->comment,
            ];

            $projectCommentsUpdate->update($data);
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Project Comment Updated Successfully Done');
    }


    public function delete(ProjectComment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->delete();
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Project Comment Deleted Successfully Done');
    }
}
