<?php

namespace App\Http\Controllers;

use App\Models\AssignProject;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AssignProjectController extends Controller
{


    public function assignProject(Request $request)
    {

        $projects = Project::get();

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->get();


        $assignProjectsQuery = AssignProject::with('assignby', 'customer', 'project');

        // dd($assignProjectsQuery->toArray());

        // If user role is "customer", restrict to projects assigned to the current user
        if (auth()->user()->hasRole('customer')) {
            $assignProjectsQuery->where('customer_id', auth()->id());
        }

        $assignProjects = $assignProjectsQuery->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.assign_projects.assign_project', compact('assignProjects', 'projects', 'customers'));
    }


    // Store
    public function store(Request $request, AssignProject $assignProject)
    {
        $this->validate($request, [
            'customer_id.*' => 'required',
            'project_id' => 'required',
        ]);

        DB::beginTransaction();
        try {

            foreach ($request->customer_id as $customer) {
                $data = [
                    'assign_by' => Auth::id(),
                    'customer_id' => $customer,
                    'project_id' => $request->project_id,
                ];

                AssignProject::updateOrCreate(
                    ['customer_id' => $customer, 'project_id' => $request->project_id],
                    $data
                );
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status', 'Assign Project Successfully done !');
    }


    // show
    // public function show(AssignProject $assignProject)
    // {
    //     $assignProject = AssignProject::with('assignby', 'customer', 'project')->find($assignProject->id);

    //     $projects = Project::get();
    //     $customers = User::whereHas('roles', function ($query) {
    //         $query->where('name', 'customer');
    //     })->get();

    //     return view('assign_projects.view', compact('assignProject', 'projects', 'customers'));
    // }


    // public function update(Request $request, AssignProject $assignProject)
    // {
    //     $this->validate($request, [
    //         'customer_id' => 'required',
    //         'project_id' => 'required',
    //     ]);

    //     DB::beginTransaction();
    //     try {

    //         $assignProject->update([
    //             // 'assign_by' => Auth::id(),
    //             'customer_id' => $request->customer_id,
    //             'project_id' => $request->project_id,
    //         ]);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->with('status', $e->getMessage());
    //     }
    //     DB::commit();
    //     return Redirect::back()->with('status', 'Assign Project Updated Successfully done !');
    // }


    // public function delete(AssignProject $assignProject)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $assignProject->delete();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->with('status', $e->getMessage());
    //     }
    //     DB::commit();
    //     return Redirect::route('projects')->with('status', 'Assign Project Deleted Successfully !');
    // }



}
