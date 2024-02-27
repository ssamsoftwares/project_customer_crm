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
                    <strong>{{ 'Project Name' }} :</strong> <i class="text-primary">
                        {{ $project->project_name ?? '' }}</i> &nbsp;&nbsp;&nbsp;
                </div>

                <div class="row m-1 mt-4 justify-content-end d-flex">

                    <div class="col-md-8">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm m-4"
                            onclick="addProjectComment(<?= $project->id ?>)"><i class="fa fa-plus"></i> Add Comment</a>
                    </div>

                    <div class="col-md-4">

                            <x-search.table-search action="{{route('projectComments',['p_id'=>$project->id])}}"
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
                                        <td>{{ ($projectComments->perPage() * ($projectComments->currentPage() - 1)) + $loop->index + 1 }}</td>

                                        <td>{{ $com->created_at->format('d-M-Y') }}</td>

                                        <td>{!! wordwrap(strip_tags(Str::ucfirst($com->comment)), 70, "<br />\n", true) !!}
                                            <br>
                                        </td>

                                        <td>{{ isset($com->commentBy->name) ? Str::ucfirst($com->commentBy->name) : '' }} </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-info btn-sm"
                                                onclick="editComment(<?= $com->id ?>)">Edit</a>
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

    {{-- Add Project Comment  Model --}}
    <div class="modal fade" id="addProjectModel" tabindex="-1" aria-labelledby="addProjectModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('projectComment.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addProjectModelLabel">{{ 'Add Project Comment' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="comment_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Comments <span class="text-danger">*</span></label>
                                <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Add Project Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Project Comment Model --}}

    <div class="modal fade" id="commentEditModel" tabindex="-1" aria-labelledby="commentEditModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('projectComment.update')}}" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="commentEditModelLabel">{{ 'Project Comment Details' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="comment_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="project_id" value="">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Comments <span class="text-danger">*</span></label>

                                <textarea id="editCommentId" name="comment" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Update Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- Add Comment --}}
    <script>
        function addProjectComment() {
            $('#addProjectModel').modal('show');
        }
    </script>

    {{-- Edit Comment --}}
    <script>
        function editComment(comment_id) {
            let url = `{{ url('project-comments-edit/${comment_id}') }}`
            $.ajax({
                type: "GET",
                url: url,
                success: function(res) {

                    console.log("result",res);

                    let model = $('#commentEditModel')

                    $('textarea[name="comment"]').val(stripHtmlTags(res.data.comment));
                    $('input[name="id"]').val(res.data.id);
                    $('input[name="project_id"]').val(res.data.project_id);

                    model.modal("show")
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function stripHtmlTags(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }
    </script>

    {{-- Project Details Script --}}
    <script>
        function projectDetailsData() {
            $('#projectDetailsModel').modal('show');
        }
    </script>
@endpush
