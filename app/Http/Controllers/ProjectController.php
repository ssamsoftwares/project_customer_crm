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

class ProjectController extends Controller
{

    public function projects(Request $request)
    {
        $query = Project::with('assignby');
        $search = $request->search;

        if (!empty($request->search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('project_name', 'like', '%' . $search . '%')
                    ->OrWhere('project_desc', 'like', '%' . $search . '%')
                    ->OrWhere('status', 'like', $search . '%')
                    ->orWhereHas('assignby', function ($assignbyQuery) use ($search) {
                        $assignbyQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $projects = $query->orderBy('id', 'desc')->paginate(10);

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->where('status', 'active')->get();


        return view('superadmin.projects.all', compact('projects', 'search', 'customers'));
    }


    public function create()
    {
        return view('superadmin.projects.add');
    }


    //Project Store
    public function store(Request $request, Project $project)
    {
        $this->validate($request, [
            'form_name' => 'required',
            'project_name' => 'required',
            'project_desc' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'assign_by' => Auth::id(),
                'form_name' => $request->form_name,
                'project_name' => $request->project_name,
                'project_desc' => $request->project_desc,
                'status' => $request->p_status
            ];

            Project::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('projects')->with('status', 'Project Added Successfully !');
    }


    //Project Edit
    public function edit(Project $project)
    {
        $assignProjectCustomers = AssignProject::with('assignby', 'customer')->where('project_id', $project->id)->get();
        $projectData = Project::where('status', 'active')->get();

        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->where('status', 'active')->get();


        return view('superadmin.projects.edit', compact('project', 'customers', 'projectData',"assignProjectCustomers"));
    }


    //Project Update
    public function update(Request $request, Project $project)
    {

        $this->validate($request, [
            // 'form_name' => 'required',
            'project_name' => 'required',
            'project_desc' => 'required',
            'p_status' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $data = [
                // 'form_name' => $request->form_name,
                'project_name' => $request->project_name,
                'project_desc' => $request->project_desc,
                'status' => $request->p_status
            ];

            $project->update($data);

            // Update project customer
            AssignProject::where('project_id',$project->id)->delete();
            foreach ($request->customer_id as $customer) {
                $data = [
                    'assign_by' => Auth::id(),
                    'customer_id' => $customer,
                    'project_id' => $project->id,
                ];

                AssignProject::create($data);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('projects')->with('status', 'Project Updated Successfully !');
    }

    public function show(Request $request, Project $project)
    {
        $search = $request->search;
        $assignProjectCustomers = AssignProject::with('assignby', 'customer')->where('project_id', $project->id);

        // dd($assignProjectCustomers->toArray());

        if (!empty($request->search)) {
            $assignProjectCustomers->whereHas('customer', function ($custSubQuery) use ($search) {
                $custSubQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }


        $assignProjectCustomers = $assignProjectCustomers->orderBy('id', 'desc')->paginate(10);
        return view('superadmin.projects.view', compact('project', 'assignProjectCustomers', 'search'));
    }



    public function delete(Project $project)
    {
        DB::beginTransaction();
        try {

            $project->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('projects')->with('status', 'Project Deleted Successfully !');
    }


}
