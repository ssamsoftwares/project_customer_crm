@extends('layouts.main')

@push('page-title')
    <title>{{ 'Dashboard' }}</title>
@endpush

@push('style')
@endpush

@push('heading')
    {{ 'Dashboard' }}
@endpush

@section('content')
    {{-- quick info --}}

    @role('superadmin')
        <div class="row">
            <x-design.card heading="Total Customers" value="{{ $total['customers'] }}" icon="mdi-account-convert"
                desc="Customers" />
            <x-design.card heading="Total Project" value="{{ $total['projects'] }}" icon="mdi-account-convert" desc="Project" />
        </div>
    @endrole

    @role('customer')
        <div class="row">
            <x-design.card heading="Total Assign Projects" value="{{ $total['custAssignProject'] }}" icon="mdi-account-convert" desc="Projects" />
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Show All Comment') }}</h5>
                        <strong>{{ 'Customer Name' }} :</strong> <i class="text-primary">
                            {{ auth()->user()->name }}</i> &nbsp;&nbsp;&nbsp;
                    </div>

                    <div class="row m-1 mt-4 justify-content-end d-flex">

                        <div class="col-md-4">

                            <x-search.table-search action="{{route('dashboard')}}" method="get" name="search"
                                value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}" btnClass="search_btn" />

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ '#' }}</th>
                                        <th>{{ 'Date' }}</th>
                                        <th>{{ 'Project Name' }}</th>
                                        <th>{{ 'Comments' }}</th>
                                        <th>{{ 'Comment By' }}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($projectComments as $projectComment)
                                    @foreach ($projectComment->project->projectComment as $comment)

                                            <tr>
                                                <td>{{ $loop->parent->iteration }}</td>
                                                <td>{{ $comment->created_at->format('d-M-Y') }}</td>
                                                <td>{{ $projectComment->project->project_name }}</td>
                                                <td>{!! wordwrap(strip_tags(Str::ucfirst($comment->comment)), 70, "<br />\n", true) !!}</td>

                                                <td>{{ $comment->commentBy->name }}</td>
                                            </tr>
                                    @endforeach
                                @endforeach

                                </tbody>


                            </table>
                        </div>
                        {{ $projectComments->appends(request()->query())->links() }}
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    @endrole







@endsection


@push('script')
@endpush
