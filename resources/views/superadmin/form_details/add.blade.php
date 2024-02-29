@extends('layouts.main')

@push('page-title')
    <title>{{ __('Details Form') }}</title>
@endpush

@push('heading')
    {{ __('Project Name -') }} {{ $project->project_name ? Str::ucfirst($project->project_name) : '' }}
@endpush

@push('style')
@endpush

@section('content')
    <b> {{ __('Customer Name -') }} {{ $customer->name ? Str::ucfirst($customer->name) : '' }}</b><br>

    <x-status-message />

    @role('superadmin')
        <a href="{{ route('project.show', ['project' => $project->id]) }}" class="btn btn-warning btn-sm m-1">
            <i class="fa fa-backward"></i> Back
        </a>
    @endrole

    @role('customer')
        <a href="{{ route('assignProjects') }}" class="btn btn-warning btn-sm m-1">
            <i class="fa fa-backward"></i> Back
        </a>
    @endrole



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('formDetail.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $form_data->id ?? null }}">

                        <input type="hidden" name="customer_id" value="{{ $customer->id ?? null }}">
                        <input type="hidden" name="project_id" value="{{ $project->id ?? null }}">
                        <input type="hidden" name="form_name"
                            value="{{ $project->form_name ?? null }}_p_{{ $project->id ?? null }}">

                        {{-- <div class="card-header d-flex justify-content-between">
                        <h5 class="align-content-center">{{ __('Basic Details') }}</h5>
                        <button type="submit" class="btn btn-primary float-end">Add <i class="fa fa-pencil-square-o"></i> Basic Details </button>
                    </div> --}}


                        {{-- Basic Details Form  Section --}}

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <x-form.input name="legal_business_name" label="Legal Business Name"
                                    value="{{ $form_data->legal_business_name ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.input name="brand_name" label="Brand name"
                                    value="{{ $form_data->brand_name ?? null }}" />
                            </div>


                            <div class="col-lg-6">
                                <x-form.input type="date" name="business_registration_establishment_date"
                                    label="Business registration / Establishment Date"
                                    value="{{ $form_data->business_registration_establishment_date ?? null }}" />
                            </div>

                            {{-- Brand Logo --}}

                            <div class="col-lg-8">
                                <label for="brand_logo">Brand Logo</label>
                                <input type="file" name="brand_logo[]" id="brand_logo" class="form-control" multiple>
                            </div>


                            <div class="col-lg-4 mt-lg-2">
                                @if (!empty($form_data->brand_logo))
                                    @php
                                        $brandLogo = json_decode($form_data->brand_logo);
                                    @endphp
                                    @foreach ($brandLogo as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger imgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="preview_brand_logo" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>


                            {{-- Brand Logo End --}}

                            <div class="col-lg-12 mt-4">
                                <x-form.textarea name="website_login_details" label="Website and login details"
                                    value="{{ $form_data->website_login_details ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.input name="primary_category" label="Primary Category"
                                    value="{{ $form_data->primary_category ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.input name="secondary_category" label="Secondary Category"
                                    value="{{ $form_data->secondary_category ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="other_category" label="Other Categories"
                                    value="{{ $form_data->other_category ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="business_description" label="Business Description (750 Characters)"
                                    value="{{ $form_data->business_description ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="keywords_related_to_business" label="10 Keywords Related to Business"
                                    value="{{ $form_data->keywords_related_to_business ?? null }}" />
                            </div>

                        </div>




                        {{-- Contact Details --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Contact Details') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-12">
                                <x-form.textarea name="contact_person_business"
                                    label="Contact Person / Business Owner / Business Manager Name"
                                    value="{{ $form_data->contact_person_business ?? null }}" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.input name="landline_primary_contact" label="Landline / Primary Contact"
                                    value="{{ $form_data->landline_primary_contact ?? null }}" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.input name="publishable_contact_mobile_number"
                                    label="Publishable Contact / Mobile Number"
                                    value="{{ $form_data->publishable_contact_mobile_number ?? null }}" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.input name="official_email_address" label="Official Email Address" type="email"
                                    value="{{ $form_data->official_email_address ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="full_business_address" label="Full Business Address"
                                    value="{{ $form_data->full_business_address ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="address_line_1" label="Address Line 1"
                                    value="{{ $form_data->address_line_1 ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="address_line_2" label="Address Line 2"
                                    value="{{ $form_data->address_line_2 ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="city" label="City" value="{{ $form_data->city ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="state" label="State" value="{{ $form_data->state ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="pincode" label="Pincode"
                                    value="{{ $form_data->pincode ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.select name="multiple_locations" label="Do you have multiple locations ?"
                                    chooseFileComment="--Select options--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->multiple_locations ?? ''" />
                            </div>

                        </div>



                        {{-- TIMINGS --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('TIMINGS') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-3">
                                <x-form.input name="working_hours_Mon_to_Fri" label="Working hours (Mon - Fri)"
                                    value="{{ $form_data->working_hours_Mon_to_Fri ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="working_hours_saturday" label="Working hours - Saturday"
                                    value="{{ $form_data->working_hours_saturday ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="working_hours_sunday" label="Working hours - Sunday"
                                    value="{{ $form_data->working_hours_sunday ?? null }}" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.input name="phone_call_timings"
                                    label="Phone Call Timings ( If not same as above )"
                                    value="{{ $form_data->phone_call_timings ?? null }}" />
                            </div>

                        </div>


                        {{-- Services Details --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Services Details') }}</h5>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-12">
                                <x-form.input name="service_location"
                                    label="Service Location (if different from original)"
                                    value="{{ $form_data->service_location ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="service_timing" label="Service timing ( If not same as above )"
                                    value="{{ $form_data->service_timing ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="services" label="Services"
                                    value="{{ $form_data->services ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="service_areas" label="Service Areas"
                                    value="{{ $form_data->service_areas ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="any_offers" label="Any Offers"
                                    value="{{ $form_data->any_offers ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="targeted_locations"
                                    label="Targeted Locations (Cities / States / Countries)"
                                    value="{{ $form_data->targeted_locations ?? null }}" />
                            </div>

                        </div>


                        {{-- Google Messages (if needed) Details --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Google Messages (if needed)') }}</h5>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <x-form.select name="messaging_enabled" label="Messaging Enabled"
                                    chooseFileComment="--Select options--" :options="[
                                        'yes' => 'yes',
                                        'no' => 'no',
                                    ]" :selected="$form_data->messaging_enabled ?? ''" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="welcome_message" label="Welcome Message"
                                    value="{{ $form_data->welcome_message ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="faq_about_business_with_answers"
                                    label="FAQ about business with answers ( 3 - 5 )"
                                    value="{{ $form_data->faq_about_business_with_answers ?? null }}" />
                            </div>

                        </div>


                        {{-- Images --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('IMAGES') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">

                            {{-- Office images --}}

                            <div class="col-lg-8">
                                <label for="office_images">Office images</label>
                                <input type="file" name="office_images[]" id="office_images" class="form-control"
                                    multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">
                                @if (!empty($form_data->office_images))
                                    @php
                                        $officeImg = json_decode($form_data->office_images);
                                    @endphp
                                    @foreach ($officeImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger officeImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>


                            {{-- Exterior --}}
                            <div class="col-lg-8">
                                <label for="exterior">Exterior</label>
                                <input type="file" name="exterior[]" id="exterior" class="form-control" multiple>
                            </div>


                            <div class="col-lg-4 mt-lg-4">
                                @if (!empty($form_data->exterior))
                                    @php
                                        $exteriorImg = json_decode($form_data->exterior);
                                    @endphp
                                    @foreach ($exteriorImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger exteriorImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>


                            {{-- Interior --}}
                            <div class="col-lg-8">
                                <label for="interior">Interior</label>
                                <input type="file" name="interior[]" id="interior" class="form-control" multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">
                                @if (!empty($form_data->interior))
                                    @php
                                        $interiorImg = json_decode($form_data->interior);
                                    @endphp
                                    @foreach ($interiorImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger interiorImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>


                            {{-- Work place --}}
                            <div class="col-lg-8">
                                <label for="work_place">Work place</label>
                                <input type="file" name="work_place[]" id="work_place" class="form-control" multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">
                                @if (!empty($form_data->work_place))
                                    @php
                                        $workPlaceImg = json_decode($form_data->work_place);
                                    @endphp
                                    @foreach ($workPlaceImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger work_placeImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                            {{-- Machines --}}
                            <div class="col-lg-8">
                                <label for="machines">Machines</label>
                                <input type="file" name="machines[]" id="machines" class="form-control" multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">
                                @if (!empty($form_data->machines))
                                    @php
                                        $machinesImg = json_decode($form_data->machines);
                                    @endphp
                                    @foreach ($machinesImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger machinesImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                            {{-- Product / Services Photos ( if any) --}}

                            <div class="col-lg-8">
                                <label for="product_services_photos">Product / Services Photos ( if any)</label>
                                <input type="file" name="product_services_photos[]" id="product_services_photos"
                                    class="form-control" multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">

                                @if (!empty($form_data->product_services_photos))
                                    @php
                                        $productServiceImg = json_decode($form_data->product_services_photos);
                                    @endphp
                                    @foreach ($productServiceImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger serviceImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                            {{-- Completed work --}}
                            <div class="col-lg-8">
                                <label for="completed_work">Completed work</label>
                                <input type="file" name="completed_work[]" id="completed_work" class="form-control"
                                    multiple>
                            </div>


                            <div class="col-lg-4 mt-lg-4">

                                @if (!empty($form_data->completed_work))
                                    @php
                                        $completWrkImg = json_decode($form_data->completed_work);
                                    @endphp
                                    @foreach ($completWrkImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger completeWrkRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                            {{-- Local ads images (if any) --}}
                            <div class="col-lg-8">
                                <label for="local_ads_images">Local ads images (if any)</label>
                                <input type="file" name="local_ads_images[]" id="local_ads_images"
                                    class="form-control" multiple>
                            </div>

                            <div class="col-lg-4 mt-lg-4">

                                @if (!empty($form_data->local_ads_images))
                                    @php
                                        $localImg = json_decode($form_data->local_ads_images);
                                    @endphp
                                    @foreach ($localImg as $key => $val)
                                        <div id="img{{ $key }}" style="display: inline-flex;">
                                            <img src="{{ asset($val) }}" alt="{{ $val }}" width="50"
                                                height="50">
                                            <a href="javascript:void(0)" class="text-danger localImgRemove"
                                                data-key="{{ $key }}" data-id="{{ $form_data->id }}"
                                                data-name="{{ $val }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="" id="" alt=""
                                        style="max-width: 50%; max-height: 100px;">
                                @endif
                            </div>

                        </div>


                        {{-- Current Office Related Questions --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Current Office Related Questions') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-12">
                                <x-form.input name="has_wheelchair_accessible_lift"
                                    label="Has wheelchair-accessible lift ?"
                                    value="{{ $form_data->has_wheelchair_accessible_lift ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="has_wheelchair_accessible_seating"
                                    label="Has wheelchair-accessible seating ?"
                                    value="{{ $form_data->has_wheelchair_accessible_seating ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="has_wheelchair_accessible_toilet"
                                    label="Has wheelchair-accessible toilet ?"
                                    value="{{ $form_data->has_wheelchair_accessible_toilet ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.input name="free_wifi" label="Free Wi-Fi ?"
                                    value="{{ $form_data->free_wifi ?? null }}" />
                            </div>


                            <div class="col-lg-4">
                                <x-form.select name="appointment_required"
                                    label="Appointment required if incase they need to visit?"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->appointment_required ?? ''" />
                            </div>


                            <div class="col-lg-4">
                                <x-form.select name="has_electronics_recycling" label="Has electronics recycling ?"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->has_electronics_recycling ?? ''" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.select name="offers_kerbside_pickup" label="Offers kerbside pickup ?"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->offers_kerbside_pickup ?? ''" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.select name="in_store_pickup_online" label="In-store pick-up for online orders ?"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->in_store_pickup_online ?? ''" />
                            </div>


                            <div class="col-lg-4">
                                <x-form.select name="has_in_store_shopping" label="Has in-store shopping"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->has_in_store_shopping ?? ''" />
                            </div>


                            <div class="col-lg-4">
                                <x-form.select name="offers_same_day_delivery" label="Offers same-day delivery"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->offers_same_day_delivery ?? ''" />
                            </div>

                        </div>



                        {{-- Payment Related Questions --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Payment Related Questions') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-3">
                                <x-form.select name="accepts_cash" label="Cash"
                                    chooseFileComment="--Select cash option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->accepts_cash ?? ''" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.select name="accepts_cheques" label="Accepts cheques"
                                    chooseFileComment="--Select cheques option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->accepts_cheques ?? ''" />
                            </div>


                            <div class="col-lg-3">
                                <x-form.select name="accepts_credit_cards" label="Accepts credit cards"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->accepts_credit_cards ?? ''" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.select name="american_express" label="American Express"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->american_express ?? ''" />
                            </div>


                            <div class="col-lg-3">
                                <x-form.select name="china_union_pay" label="China Union Pay"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->china_union_pay ?? ''" />
                            </div>


                            <div class="col-lg-3">
                                <x-form.select name="diners_club" label="Diners Club"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->diners_club ?? ''" />
                            </div>

                            <div class="col-lg-3">
                                <x-form.select name="discover" label="Discover" chooseFileComment="--Select option--"
                                    :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->discover ?? ''" />
                            </div>


                            <div class="col-lg-3">
                                <x-form.select name="jcb" label="JCB" chooseFileComment="--Select option--"
                                    :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->jcb ?? ''" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.select name="mastercard" label="Mastercard" chooseFileComment="--Select option--"
                                    :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->mastercard ?? ''" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.select name="accepts_debit_cards" label="Accepts debit cards"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->accepts_debit_cards ?? ''" />
                            </div>

                            <div class="col-lg-4">
                                <x-form.select name="accepts_nfc_mobile_payments" label="Accepts NFC mobile payments"
                                    chooseFileComment="--Select option--" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" :selected="$form_data->accepts_nfc_mobile_payments ?? ''" />
                            </div>

                        </div>


                        {{-- Social Profile Links --}}
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5 class="mb-2">{{ __('Social Profile Links') }}</h5>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <p class="text-danger">
                                <b>{{ 'Please provide Social Details (Social Account,Account link,Username,Password)' }}</b>
                            </p>

                            <div class="col-lg-6">
                                <x-form.textarea name="facebook" label="Facebook"
                                    value="{{ $form_data->facebook ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.textarea name="instagram" label="Instagram"
                                    value="{{ $form_data->instagram ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.textarea name="twitter" label="Twitter"
                                    value="{{ $form_data->twitter ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.textarea name="linkedin" label="Linkedin"
                                    value="{{ $form_data->linkedin ?? null }}" />
                            </div>

                            <div class="col-lg-6">
                                <x-form.textarea name="pinterest" label="Pinterest"
                                    value="{{ $form_data->pinterest ?? null }}" />
                            </div>


                            <div class="col-lg-6">
                                <x-form.textarea name="youtube" label="Youtube"
                                    value="{{ $form_data->youtube ?? null }}" />
                            </div>

                            <div class="col-lg-12">
                                <x-form.textarea name="other_social_media_links" label="Other Social media links"
                                    value="{{ $form_data->other_social_media_links ?? null }}" />
                            </div>

                        </div>

                        {{-- @if (isset($customer->id) && isset($project->id))

                        @endif --}}

                        <div>
                            <button class="btn btn-primary mt-2" type="submit">{{ __('Submit Form Details') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Initialize TinyMCE
        function initTinyMCE(selector) {
            if ($(selector).length > 0) {
                tinymce.init({
                    selector: selector,
                    height: 150,
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor"
                    ],
                    toolbar: "undo redo | formatselect | " +
                        "bold italic backcolor | alignleft aligncenter " +
                        "alignright alignjustify | bullist numlist outdent indent | " +
                        "removeformat | link image | code",
                    menubar: false
                });
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            // Initialize TinyMCE for textareas ids
            initTinyMCE('#facebook');
            initTinyMCE('#instagram');
            initTinyMCE('#twitter');
            initTinyMCE('#linkedin');
            initTinyMCE('#pinterest');
            initTinyMCE('#youtube');
            initTinyMCE('#other_social_media_links');

            initTinyMCE('#welcome_message');
            initTinyMCE('#faq_about_business_with_answers');

        });
    </script>


    <script>
        $(document).ready(function() {
            $('.selectUsers').select2();

            // REMOVE Brand Logo Image

            $('.imgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let brand_logo = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.formUpdateTimeDeleteBrandLogo') }}",
                        data: {
                            'id': id,
                            'brand_logo': brand_logo
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            // REMOVE Office Image
            $('.officeImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let office_images = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteOfficeImg') }}",
                        data: {
                            'id': id,
                            'office_images': office_images
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            // REMOVE exterior Image
            $('.exteriorImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let exterior = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteExteriorImg') }}",
                        data: {
                            'id': id,
                            'exterior': exterior
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            // REMOVE INTERIOR Image
            $('.interiorImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let interior = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteInteriorImg') }}",
                        data: {
                            'id': id,
                            'interior': interior
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            // REMOVE WORK Place Image
            $('.work_placeImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let work_place = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteWorkPlace') }}",
                        data: {
                            'id': id,
                            'work_place': work_place
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })


            // REMOVE MACHINES IMAGES  Image
            $('.machinesImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let machines = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteMachines') }}",
                        data: {
                            'id': id,
                            'machines': machines
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            //REMOVE Product Service IMAGES  Image
            $('.serviceImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let product_services_photos = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteServiceImg') }}",
                        data: {
                            'id': id,
                            'product_services_photos': product_services_photos
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })


            //REMOVE Complet WRK IMAGES  Image
            $('.completeWrkRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let completed_work = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteCompletWrkImg') }}",
                        data: {
                            'id': id,
                            'completed_work': completed_work
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



            //REMOVE LOCAL ADS IMAGES  Image
            $('.localImgRemove').on('click', function() {
                let cmr = confirm('Are you sure delete this image.');
                if (cmr) {
                    let id = $(this).data('id')
                    let local_ads_images = $(this).data('name')
                    let key = $(this).data('key')
                    $.ajax({
                        type: "post",
                        url: "{{ route('formDetail.deleteLocalAdsImg') }}",
                        data: {
                            'id': id,
                            'local_ads_images': local_ads_images
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.msg === 'success') {
                                console.log(`#img${key}`)
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            })



        });
    </script>


    <script>
        // Image preview
        function loadFile(event, outputId) {
            var output = document.getElementById(outputId);
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            } else {
                output.src = ""; // Set the image source to blank if no file is selected
            }
        }
    </script>
@endpush
