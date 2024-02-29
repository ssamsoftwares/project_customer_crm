@extends('layouts.main')

@push('page-title')
    <title>{{ __('Edit Project Details') }}</title>
@endpush

@push('heading')
    {{ __('Edit Project Details') }} : {{ $project->project_name }}
@endpush
@push('style')
@endpush

@section('content')
    <x-status-message />
    <a href="{{ route('project.show', ['project' => $project->id]) }}" class="btn btn-warning btn-sm m-1">
        <i class="fa fa-backward"></i> Back
    </a>
    <div class="row">

        {{-- <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('project.update', [$project->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}">
                        <h4 class="card-title mb-3">{{ __('Project Details') }}</h4>

                        <div class="row mt-4">
                            <div class="col-3">
                                <label for="">{{ 'Projects' }}</label>
                                <select name="project_id" id="project_id" class="form-control" required>
                                    <option value="" disabled selected>--Select Projects--</option>
                                    @foreach ($projectData as $p)
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

                            <div class="col-4">
                                <label for="">{{ 'Form' }}</label>
                                <select name="form_id[]" id="form_id" class="form-control select_forms" required
                                    multiple="multiple">
                                    @foreach ($forms as $form)
                                        <option value="{{ $form->id }}">{{ $form->form_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2 mt-lg-4">
                                <input type="submit" value="Assign Project" class="btn btn-info">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('project.update', [$project->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}">
                        <h4 class="card-title mb-3">{{ __('Project Details') }}</h4>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <x-form.input name="project_name" label="Project Name" :value="$project->project_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <x-form.textarea name="project_desc" label="Project Description" :value="$project->project_desc" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form.select name="p_status" label="Status" chooseFileComment="--Select Status--"
                                    :options="[
                                        'active' => 'Active',
                                        'block' => 'Block',
                                    ]" :selected="$project->status" />
                            </div>


                            <div class="col-lg-6">
                                <label for="">{{ 'Customer' }}</label>
                                <select name="customer_id[]" id="customer_id" class="form-control" multiple required>
                                    <option value="" disabled>--Select Customers--</option>
                                    @foreach ($customers as $cust)
                                        @php
                                            $isSelected = false;
                                            foreach ($assignProjectCustomers as $assignment) {
                                                if ($assignment['customer_id'] == $cust->id) {
                                                    $isSelected = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <option value="{{ $cust->id }}" {{ $isSelected ? 'selected' : '' }}>{{ $cust->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary mt-2" type="submit">{{ __('Update Project Details') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(".select_forms").select2({
            placeholder: "Select a Form"
        });
    </script>

<script>
    $(document).ready(function() {
       $('#customer_id').select2({
        placeholder: "Select Customer"
       });
   });
</script>
@endpush
