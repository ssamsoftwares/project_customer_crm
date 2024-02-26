<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
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

        $total['customers']  = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->where('status','active')->count();

        $total['projects'] = Project::where('status','active')->count();

        return view('dashboard', compact('total'));
    }
}
