@extends('layouts.main')

@push('page-title')
    <title>Project Comments Details</title>
@endpush

@push('heading')
    {{ 'Project Comments -' }} {{ $project->project_name }}
@endpush

@section('content')
    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .ri-eye-line:before {
                content: "\ec95";
                position: absolute;
                left: 13px;
                top: 5px;
            }

            a.btn.btn-primary.waves-effect.waves-light.view {
                width: 41px;
                height: 32px;
            }

            .action-btns.text-center {
                display: flex;
                gap: 10px;
            }

            .ri-pencil-line:before {
                content: "\ef8c";
                position: absolute;
                left: 13px;
                top: 5px;
            }

            a.btn.btn-info.waves-effect.waves-light.edit {
                width: 41px;
                height: 32px;
            }

            table.dataTable>tbody>tr.child ul.dtr-details>li {
                white-space: nowrap !important;
            }

            input[switch]+label:after {

                left: -22px;
                margin-left: 25px;

            }

            input[switch]+label {
                width: 80px !important;
            }


            input[switch=bool]:checked+label {
                background-color: #f32f53;
            }

            .modal-content {
                z-index: 1051;
                /* Ensure it's above the overlay (1050) */
            }

            /* Adjust the z-index of the TinyMCE toolbar to appear above the modal */
            .tox-tinymce {
                z-index: 1060;
                /* Ensure it's above the modal content */
            }
        </style>
    @endpush

    <x-status-message />

    {{-- Customer Profile details --}}
    <a href="{{ route('projects') }}" class="btn btn-warning btn-sm m-1">
        <i class="fa fa-backward"></i> Back
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Show All Comment') }}</h5>

                    <strong>{{ 'Assign Project Customers Name' }} :</strong>
                    @foreach ($assignProjectsCustomer as $cust)
                        <i class="text-primary">
                            {{ $cust->customer->name }},
                        </i>
                    @endforeach &nbsp;&nbsp;&nbsp;
                </div>

                <div class="row m-1 mt-4 justify-content-end d-flex">

                    <div class="col-md-8">
                        <a href="{{ route('projectComment.create', ['p_id' => $project->id]) }}"
                            class="btn btn-primary btn-sm m-4"><i class="fa fa-plus"></i> Add Comment</a>
                    </div>

                    <div class="col-md-4">

                        <x-search.table-search action="{{ route('projectComments', ['p_id' => $project->id]) }}"
                            method="get" name="search"
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
                                    <th>{{ 'Comments' }}</th>
                                    <th>{{ 'Comments By' }}</th>
                                    <th>{{ 'Action' }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($projectComments as $com)
                                    <tr>
                                        <td>{{ $projectComments->perPage() * ($projectComments->currentPage() - 1) + $loop->index + 1 }}
                                        </td>

                                        <td>{{ $com->created_at->format('d-M-Y') }}</td>

                                        <td>{!! wordwrap(strip_tags(Str::ucfirst($com->comment)), 70, "<br />\n", true) !!}
                                            <br>
                                        </td>

                                        <td>{{ isset($com->commentBy->name) ? Str::ucfirst($com->commentBy->name) : '' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('projectComment.edit', ['comment' => $com->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="{{ route('projectComment.delete', ['comment' => $com->id]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure delete this comment!')"><i
                                                    class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $projectComments->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
@push('script')

@endpush
