@extends('layouts.main')

@push('page-title')
    <title>All Asign Project </title>
@endpush

@push('heading')
    {{ 'Asign Project to Customer list' }}
@endpush

@section('content')
    @push('style')
        <style>
        </style>
    @endpush

    <x-status-message />

    @role('superadmin')
        {{-- <div class="card p-lg-4">
            <form action="{{ route('assignProject.store') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-3">
                        <label for="">{{ 'Projects' }}</label>
                        <select name="project_id" id="project_id" class="form-control" required>
                            <option value="" disabled selected>--Select Projects--</option>
                            @foreach ($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->project_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">{{ 'Customer' }}</label>
                        <select name="customer_id" id="customer_id" class="form-control" required>
                            <option value="" disabled selected>--Select Customers--</option>
                            @foreach ($customers as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">{{ 'Form' }}</label>
                        <select name="form_id" id="form_id" class="form-control" required>
                            <option value="" disabled selected>--Select Customers--</option>
                            @foreach ($customers as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2 mt-lg-4">
                        <input type="submit" value="Assign Project" class="btn btn-info">
                    </div>
                </div>
            </form>
        </div> --}}
    @endrole


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="justify-content-end d-flex">
                    <x-search.table-search action="{{ route('assignProjects') }}" method="get" name="search"
                        value="{{ $search }}" btnClass="search_btn" />
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ '#' }}</th>
                                    <th>{{ 'Project Name' }}</th>
                                    <th>{{ 'Project Description' }}</th>
                                    <th>{{ 'Assign By' }}</th>
                                    <th>{{ 'Fill the Form' }}</th>
                                    @role('superadmin')
                                        <th>{{ 'Actions' }}</th>
                                    @endrole
                                </tr>
                            </thead>

                            <tbody id="candidatesData">

                                @foreach ($assignProjects as $p)
                                    <tr>
                                        <td>{{ $assignProjects->perPage() * ($assignProjects->currentPage() - 1) + $loop->index + 1 }}
                                        </td>

                                        <td>{{ $p->project->project_name }}</td>
                                        <td>{{ $p->project->project_desc }}</td>
                                        <td>{{ $p->assignby->name }}
                                            <br>
                                            <span>Date: {{ $p->created_at->format('d-M-Y') }}</span>
                                        </td>

                                        <td>
                                            <a href="{{ route('formDetail.create', ['c_id' => $p->customer->id]) }}"
                                                class="btn btn-info btn-sm">{{ $p->project->form_name }}</a>

                                            <a href="{{ route('viewCustomerProjectComments', ['projectId' => $p->project->id]) }}"
                                                class="btn btn-success btn-sm">View Comments</a>
                                        </td>

                                        <td>
                                            @role('superadmin')
                                                <a href="{{ route('assignProject.show', ['assignProject' => $p->id]) }}"
                                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('assignProject.delete', ['assignProject' => $p->id]) }}"
                                                    onclick="return confirm('Are you sure delete this project')"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                            @endrole
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $assignProjects->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('script')
@endpush
