@extends('layouts.main')

@push('page-title')
    <title>All Project</title>
@endpush

@push('heading')
    {{ 'All Project' }}
@endpush

@section('content')
    @push('style')
        <style>
        </style>
    @endpush

    <x-status-message />


    @role('superadmin')
        <div class="card p-lg-4">
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
                        <select name="customer_id[]" id="customer_id" class="form-control" multiple required>
                            <option value="" disabled>--Select Customers--</option>
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
        </div>
    @endrole




    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="justify-content-end d-flex">
                    <x-search.table-search action="{{ route('projects') }}" method="get" name="search"
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
                                    <th>{{ 'Status' }}</th>
                                    <th>{{ 'Actions' }}</th>
                                </tr>
                            </thead>

                            <tbody id="candidatesData">

                                @foreach ($projects as $p)
                                    <tr>
                                        <td>{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->index + 1 }}
                                        </td>

                                        <td>{{ $p->project_name }}</td>
                                        <td>{{ $p->project_desc }}</td>
                                        <td>{{ Str::ucfirst($p->status)}}</td>

                                        <td>
                                            <a href="{{ route('project.show', ['project' => $p->id]) }}"
                                                class="btn btn-primary"><i class="fa fa-eye"></i> </a>

                                            <a href="{{ route('project.edit', ['project' => $p->id]) }}"
                                                class="btn btn-warning"><i class="fa fa-pencil"></i> </a>

                                            <a href="{{ route('project.delete', ['project' => $p->id]) }}"
                                                onclick="return confirm('Are you sure delete this project')"
                                                class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('script')

<script>
//     $(".select_forms").select2({
//     placeholder: "Select a Form"
// });

</script>

<script>
    $(document).ready(function() {
       $('#customer_id').select2({
        placeholder: "Select Customer"
       });
   });
</script>
@endpush
