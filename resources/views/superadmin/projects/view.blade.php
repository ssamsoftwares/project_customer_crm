@extends('layouts.main')

@push('page-title')
    <title>View Project</title>
@endpush

@push('heading')
    {{ 'Project -' }} {{$project->project_name}}
@endpush

@section('content')
    @push('style')
        <style>
        </style>
    @endpush

    <x-status-message />

    <a href="{{route('projects')}}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i> Back</a>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-secondary rounded">
                <div class="card-header d-flex justify-content-between">
                    <h5>{{ 'Project Profile' }}</h5>
                    {{-- @role('superadmin')
                        <a href="#"
                            class="float-end btn btn-info"><i class="fa fa-pencil-square"></i></a>
                    @endrole --}}
                </div>

                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-4">
                            <b>Project Name :</b>
                            <span>
                                {{ $project->project_name }}
                            </span>
                        </div>

                        <div class="col-4">
                            <b>Assign By:</b>
                            <span>
                                {{ $project->assignby->name }}
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
                    <x-search.table-search action="{{route('project.show',['project'=>$project->id])}}" method="get" name="search"
                        value="{{$search}}" btnClass="search_btn" />
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


                                            <a href="{{route('formDetail.create',['c_id'=>$customer->customer->id,'p_id'=>$customer->project->id])}}" class="btn btn-success btn-sm">Add / <i class="fa fa-pencil-square-o"></i>  {{Str::ucfirst($customer->project->form_name)}}</a>


                                            <a href="{{route('formDetail.viewCustomerGetDetailsForm',['c_id'=>$customer->customer->id,'p_id'=>$customer->project->id])}}" class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Preview </a>



                                        </td>


                                        <td>

                                            <a href="{{ route('users.show',$customer->customer->id) }}" class="btn btn-primary btn-sm"> {{'Customer Profile'}} </a>

                                            <a href="{{route('assignProject.delete',['assignProject'=>$customer->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure remove this customer in this project')" >{{'Delete'}}</a>
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
@endsection

@push('script')

<script>
    $(".select_forms").select2({
    placeholder: "Select a Form"
});

</script>
@endpush
