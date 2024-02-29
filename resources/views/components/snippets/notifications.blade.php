<?php
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectCommentNotification;
use App\Models\Project;
use App\Models\User;
use App\Models\AssignProject;
use Carbon\Carbon;

$user = Auth::user();

// Get all projects assigned to the auth user
// $assignedProjects = AssignProject::with('project', 'project.projectCommentNotification')
//     ->where('customer_id', $user->id)
//     ->get();

$assignedProjects = AssignProject::with([
    'project',
    'project.projectCommentNotification' => function ($query) {
        $query->where('status', 'unseen');
    },
])
    ->where('customer_id', $user->id)
    ->get();

$totalNotificationCount = 0;

foreach ($assignedProjects as $assignProject) {
    // Retrieve the project
    $project = $assignProject->project;

    // Retrieve the notification count for this project's customer
    $notificationCount = $project->projectCommentNotification()->where('status', 'unseen')->count();
    $totalNotificationCount += $notificationCount;
}
?>


@if ($show == 'true')
    @role('customer')
        <!-- notification section -->
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" style="padding:21px;"
                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-notification-3-line"></i>
                {{-- <span class="noti-dot"> </span> --}}
                <span
                    style="position: absolute;background: red;/* padding: 5px; */width: 20px !important;z-index: 9999 !important;height: 20px;border-radius: 100%;">{{ $totalNotificationCount }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0">New Comment Notifications </h6>
                        </div>
                        {{-- <div class="col-auto">
                            <a href="#!" class="small"> View All</a>
                        </div> --}}
                    </div>
                </div>


                <div data-simplebar style="max-height: 230px;">
                    @foreach ($assignedProjects as $not)
                        @foreach ($not->project->projectCommentNotification as $notification)
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex m-2">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeeZ2dCkLZqVPPJLqbTYkt_2Y-PXVSUjQ2yHmXoPdiWXup5_TetPLNCRVLejsHKeNQG-0&usqp=CAU"
                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <a href="{{ route('markAsReadNotification', ['notification' => $notification->id]) }}"
                                            class="float-end m-2"> Mark as read</a>
                                        <h6 class="mb-1">{{ $not->project->project_name }}</h6>


                                        <div class="font-size-12 text-muted">

                                            <p class="mb-1">{!! wordwrap(strip_tags(Str::ucfirst($notification->notification_msg)), 70, "<br />\n", true) !!}
                                                <br>
                                            </p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                {{ Carbon::parse($notification->created_at)->diffForHumans() }}</p>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                </div>

                <div class="p-2 border-top">
                    <div class="d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> Mark All as read..
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endif
