@extends('layouts.main')

@push('page-title')
    <title>{{ __('Add Project') }}</title>
@endpush

@push('heading')
    {{ __('Add Project') }}
@endpush

@push('style')
@endpush

@section('content')
    <x-status-message />

    <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm m-1">
        <i class="fa fa-backward"></i> Back
    </a>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('project.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h4 class="card-title mb-3">{{ __('Project Details') }}</h4>


                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <x-form.input name="project_name" label="Project Name*" />
                            </div>
                            <div class="col-lg-12">
                                <x-form.textarea name="project_desc" label="Project Description*" />
                            </div>

                        </div>



                        <div class="row">

                            <div class="col-lg-6">
                                <x-form.select name="form_name" label="Form*"
                                    chooseFileComment="--Select Form--" :options="[
                                        'form_1' => 'Form-1',
                                    ]" />
                            </div>


                            <div class="col-lg-6">
                                <x-form.select name="p_status" label="Status"
                                    chooseFileComment="--Select Status--" :options="[
                                        'active' => 'Active',
                                        'block' => 'Block',
                                    ]" />
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
            $('.selectUsers').select2();
        });
    </script>
@endpush
