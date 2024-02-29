@extends('layouts.main')

@push('page-title')
    <title>{{ __('Add Project Comment') }}</title>
@endpush

@push('heading')
    {{ __('Add Comment Project') }}
@endpush

@push('style')
@endpush

@section('content')
    <x-status-message />

    <a href="{{route('projectComments',['p_id'=>$project->id])}}" class="btn btn-warning btn-sm m-1">
        <i class="fa fa-backward"></i> Back
    </a>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('projectComment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="comment_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <h4 class="card-title mb-3">{{ __('Add Project Comment') }}</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Comments <span class="text-danger">*</span></label>
                                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary mt-2" type="submit">{{ __('Add Project Details') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Initialize TinyMCE for textareas ids
        initTinyMCE('#comment');

    });
</script>
@endpush
