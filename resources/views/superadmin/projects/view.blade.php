@extends('layouts.main')

@push('page-title')
    <title>View Project</title>
@endpush

@push('heading')
    {{ 'Project -' }} {{ $project->project_name }}
@endpush

@section('content')
    @push('style')
        <style>
        </style>
    @endpush

    <x-status-message />

    <a href="{{ route('projects') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i> Back</a>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-secondary rounded">
                <div class="card-header d-flex justify-content-between">
                    <h5>{{ 'Project Profile' }}</h5>

                    @role('superadmin')
                       <div>
                        <a href="{{ route('project.edit', ['project' => $project->id]) }}" class="float-end btn btn-info m-1"><i class="fa fa-pencil-square"></i></a>

                        {{-- <a href="javascript:void(0)" class="btn btn-primary btn-sm m-1"
                            onclick="addProjectComment(<?= $project->id ?>)"><i class="fa fa-plus"></i> Project Comment</a> --}}

                            <a href="{{ route('projectComments',['p_id' =>$project->id]) }}"
                                class="btn btn-warning btn-sm mt-2">All Comments </a>
                       </div>
                    @endrole
                </div>

                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-4">
                            <b>Project Name :</b>
                            <span>
                                {{ $project->project_name ?? '' }}
                            </span>
                        </div>

                        <div class="col-4">
                            <b>Assign By:</b>
                            <span>
                                {{ $project->assignby->name ?? '' }}
                            </span>
                        </div>

                        <div class="col-4">
                            <strong>Status :</strong>
                            <strong>
                                {{ isset($project->status) ? Str::ucfirst($project->status) : 'No Status' }}
                            </strong>
                        </div>
                        <hr>

                        <div class="col-12">
                            <label for="">Project Description :</label>
                            <p class="text-dark">
                                {{ isset($project->project_desc) ? trim($project->project_desc) : 'No project description' }}
                            </p>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    <h4 class="card-title mb-3">{{ __('Assign Project Customer List') }}</h4>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="justify-content-end d-flex">
                    <x-search.table-search action="{{ route('project.show', ['project' => $project->id]) }}" method="get"
                        name="search" value="{{ $search }}" btnClass="search_btn" />
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ '#' }}</th>
                                    <th>{{ 'Custome Name' }}</th>
                                    <th>{{ 'Custome Email' }}</th>
                                    <th>{{ 'Assign By' }}</th>
                                    <th>{{ 'Forms' }}</th>
                                    <th>{{ 'Actions' }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($assignProjectCustomers as $customer)
                                    <tr>
                                        <td>{{ $assignProjectCustomers->perPage() * ($assignProjectCustomers->currentPage() - 1) + $loop->index + 1 }}
                                        </td>

                                        <td>{{ $customer->customer->name ?? 'No Customer' }}</td>
                                        <td>{{ $customer->customer->email ?? 'No Email' }}</td>
                                        <td>{{ $customer->assignby->name ?? 'No Assign By' }}</td>

                                        <td>
                                            {{-- @php
                                                $formIds = json_decode($customer['form_id']);
                                            @endphp

                                            @foreach ($formIds as $formId)
                                                <a href="{{route('form.view',['form_id'=>$formId])}}" class="btn btn-info btn-sm">{{'Form -'}}{{$formId}}</a>
                                            @endforeach --}}
                                            {{-- {{$customer->project->form_name}} --}}


                                            <a href="{{ route('formDetail.create', ['c_id' => $customer->customer->id, 'p_id' => $customer->project->id]) }}"
                                                class="btn btn-success btn-sm">Add / <i class="fa fa-pencil-square-o"></i>
                                                {{ Str::ucfirst($customer->project->form_name) }}</a>


                                            <a href="{{ route('formDetail.viewCustomerGetDetailsForm', ['c_id' => $customer->customer->id, 'p_id' => $customer->project->id]) }}"
                                                class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Preview </a>

                                        </td>


                                        <td>

                                            <a href="{{ route('users.show', $customer->customer->id) }}"
                                                class="btn btn-primary btn-sm"> {{ 'Customer Profile' }} </a>

                                            <a href="{{ route('assignProject.delete', ['assignProject' => $customer->id]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure remove this customer in this project')">{{ 'Delete' }}</a>
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $assignProjectCustomers->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    {{-- Add Project Comment  Model --}}
    <div class="modal fade" id="addProjectModel" tabindex="-1" aria-labelledby="addProjectModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('projectComment.store') }}" method="post">
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
                                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
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
@endsection

@push('script')
    <script>
        $(".select_forms").select2({
            placeholder: "Select a Form"
        });

        function addProjectComment() {
            $('#addProjectModel').modal('show');
        }
    </script>



<script>
    $(document).ready(function() {
        // Initialize TinyMCE for textareas ids
        initTinyMCE('#comment');

    });
</script>
@endpush
