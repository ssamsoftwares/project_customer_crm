@extends('layouts.main')

@push('page-title')
    <title>All Asign Project Comments </title>
@endpush

@push('heading')
    {{ 'Asign Project to Customer Comment list' }}
@endpush

@section('content')
    @push('style')
        <style>
        </style>
    @endpush

    <x-status-message />

    <a href="{{ route('assignProjects') }}" class="btn btn-warning btn-sm m-2"><i class="fa fa-backward"></i>
        {{ 'Back' }}</a>
    <div class="row">
        <div class="col-12">
            <div class="m-1">
                <Strong>{{ 'Project Name :' }}</Strong> <span>{{ $project->project_name }}</span>
            </div>
            <div class="card">
                <form action="{{ route('viewCustomerProjectComments', ['projectId' => $project->id]) }}" method="get">
                    <div class="row m-2">

                        <div class="col-lg-3">
                            <x-form.input name="from_date" label="Comment Date From" type="date"
                                value="{{ isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : '' }}" />
                        </div>

                        <div class="col-lg-3">
                            <x-form.input name="to_date" label="Date To" type="date"
                                value="{{ isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '' }}" />
                        </div>

                        <div class="col-lg-4 mt-lg-4 my-search">
                            <input type="search" name="search" id="search" placeholder="Search....."
                                class="form-control" value="{{ isset($_REQUEST['search']) ? $_REQUEST['search'] : '' }}">
                        </div>

                        <div class="col-lg-2 mt-lg-4">
                            <input type="submit" class="btn btn-primary" value="Filter">
                            <a href="{{ route('viewCustomerProjectComments', ['projectId' => $project->id]) }}"
                                class="btn btn-secondary">Reset</a>
                        </div>

                    </div>
                </form>




                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ '#' }}</th>
                                    <th>{{ 'Date' }}</th>
                                    <th>{{ 'Comment' }}</th>
                                    <th>{{ 'Comment By' }}</th>

                                </tr>
                            </thead>

                            <tbody id="">

                                @foreach ($comments as $comm)
                                    <tr>
                                        <td>{{ $comments->perPage() * ($comments->currentPage() - 1) + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $comm->created_at->format('d-M-Y') }}</td>
                                        <td>{!! wordwrap(strip_tags(Str::ucfirst($comm->comment)), 70, "<br />\n", true) !!}
                                            <br>
                                        </td>
                                        <td>{{ $comm->commentBy->name }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $comments->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('script')
@endpush
