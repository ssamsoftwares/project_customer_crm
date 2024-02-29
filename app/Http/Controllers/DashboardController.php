<?php

namespace App\Http\Controllers;

use App\Models\AssignProject;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */


    public function __invoke(Request $request)
    {
        $authUser = Auth::user();
        $total['customers']  = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->where('status', 'active')->count();

        $total['projects'] = Project::where('status', 'active')->count();

        $total['custAssignProject'] = AssignProject::where('customer_id', $authUser->id)->count();


        // Show Project Comments Customer dashboard

        $search = $request->search;

        $projectComments = AssignProject::with(['project.projectComment' => function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                if (!empty($search)) {
                    // Search by comment date
                    if (Carbon::hasFormat($search, 'd-M-Y')) {
                        $formattedDate = Carbon::createFromFormat('d-M-Y', $search)->format('Y-m-d');
                        $query->whereDate('created_at', $formattedDate);
                    } else {
                        // Search by keyword in comment, project name, or commenter's name
                        $query->where('comment', 'like', "%$search%")
                            ->orWhereHas('project', function ($query) use ($search) {
                                $query->where('project_name', 'like', "%$search%");
                            })
                            ->orWhereHas('commentBy', function ($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                    }
                }
            });
        }])
        ->where('customer_id', $authUser->id)
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('dashboard', compact('total', 'projectComments'));
    }
}
