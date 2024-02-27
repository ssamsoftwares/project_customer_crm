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
                                    <th>{{ 'Comments' }}</th>
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
                                            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="viewProjectComment(<?= $p->id ?>)">View Comments </a>

                                            {{-- <a href="javascript:void(0)" class="btn btn-warning btn-sm"
                                            onmouseover="viewProjectComment(<?= $p->id?>)">View Comment</a> --}}
                                        </td>

                                        <td>
                                            <a href="{{ route('project.show', ['project' => $p->id]) }}"
                                                class="btn btn-primary"><i class="fa fa-eye"></i> </a>

                                                <a href="{{ route('project.delete', ['project' => $p->id]) }}"
                                                    onclick="return confirm('Are you sure delete this project')"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i> </a>

                                                <a href="{{ route('projectComments',['p_id' =>$p->id]) }}"
                                                    class="btn btn-info btn-sm">Comments </a>

                                            {{-- <a href="{{ route('project.edit', ['project' => $p->id]) }}"
                                                class="btn btn-warning"><i class="fa fa-pencil"></i> </a> --}}

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


     {{-- Comment Model Form --}}

     <div class="modal fade" id="commentViewModel" tabindex="-1" aria-labelledby="commentViewModelLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5 text-dark" id="commentViewModelLabel">{{ 'View Project Comments' }}</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <ul id="commentList"></ul>
             </div>
         </div>
     </div>
 </div>


@endsection

@push('script')

<script>
    $(document).ready(function() {
       $('#customer_id').select2({
        placeholder: "Select Customer"
       });
   });
</script>


<script>
    function viewProjectComment(projectId) {
        $.ajax({
            url: '/project-all-comments/' + projectId,
            type: 'GET',
            success: function(response) {

                var project = response.project;
                var comments = response.comments;
                var commentList = $('#commentList');
                var modalTitle = $('#commentViewModelLabel');

                modalTitle.text('View Project Comments - ' + project.project_name);

                commentList.empty();

                if (comments.length > 0) {
                    comments.forEach(function(comment) {
                        var formattedDate = new Date(comment.created_at).toLocaleDateString(
                            'en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            });

                        var listItem = $('<li></li>');
                        var commentContainer = $('<div></div>');
                        var commentText = $('<strong>' + comment.comment + '</strong>');
                        var dateText = $('<span style="color: #0F7694; font-weight: bold;">' + ' - ' +
                            formattedDate + '</span>')

                        commentContainer.append(commentText);
                        commentContainer.append(dateText);
                        listItem.append(commentContainer);
                        commentList.append(listItem);
                    });
                } else {
                    commentList.append('<strong>No comments available.</strong>');
                }

                // Show the modal
                $('#commentViewModel').modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    // mouseenter
    // $('.btn-close').on('mouseenter', function() {
    //     closeCommentModal();
    // });

    // function closeCommentModal() {
    //     // Check if the modal is open
    //     var isModalOpen = $('body').hasClass('modal-open');
    //     if (isModalOpen) {
    //         // Close the modal
    //         $('#commentViewModel').modal('hide');
    //         // Remove the data attribute
    //     }
    // }
</script>





@endpush
