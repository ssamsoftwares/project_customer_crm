<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            @if (auth()->check())
                @if (auth()->user()->hasRole('superadmin') ||
                        auth()->user()->hasRole('customer'))
                    <div class="mt-3">
                        <h4 class="font-size-16 mb-1">Hello {{ ucfirst(request()->user()->name) }}</h4>
                        <span class="text-muted">
                            <i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                            {{ ucfirst(request()->user()->role) }}
                        </span>
                    </div>

                @endif
            @endif
        </div>


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                    <li>
                        <a href="{{ route('dashboard') }}" class="waves-effect">
                            <i class="ri-vip-crown-2-line"></i>
                            <span>{{'Dashboard'}}</span>
                        </a>
                    </li>

                    @role('superadmin')
                        <li class="menu-title">{{'Customer'}}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-account-circle-line"></i>
                                <span>{{'Customer'}}</span>
                            </a>

                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('users.index') }}">View All</a></li>
                                <li><a href="{{ route('users.create') }}">Add New</a></li>
                            </ul>

                        </li>

                        {{-- <li class="menu-title">{{'Form Detail Preview'}}</li>
                        <li>
                            <a href="{{ route('formDetail.preview') }}" class="waves-effect">
                                <i class="ri-vip-crown-2-line"></i>
                                <span>{{'Form Details Preview'}}</span>
                            </a>
                        </li> --}}


                        <li class="menu-title">{{'Projects'}}</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-account-circle-line"></i>
                                <span>{{'Projects'}}</span>
                            </a>

                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('project.create')}}">Add Project</a></li>
                                <li><a href="{{route('projects')}}">View All</a></li>
                            </ul>

                        </li>

                    @endrole

                    @role('customer')
                    
                    <li>
                        <a href="{{ route('assignProjects') }}" class="waves-effect">
                            <i class="ri-vip-crown-2-line"></i>
                            <span>{{'Assign Projects'}}</span>
                        </a>
                    </li>
                    @endrole


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
