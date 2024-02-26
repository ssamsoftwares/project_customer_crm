@extends('layouts.main')
@push('page-title')
    <title>{{ 'Customer Form details - ' }} </title>
@endpush

@push('heading')
    {{ 'Project Name : ' }}  {{$project->project_name ? Str::ucfirst($project->project_name): ""}}
@endpush
<br>

@section('content')
<p>
    {{ 'Customer Form details : ' }}  {{$customer->name ? Str::ucfirst($customer->name): ""}}
</p>
<a href="{{url()->previous()}}" class="btn btn-warning btn-sm">Back</a>
    {{-- customer Form details --}}
    <x-status-message />
    <div class="row d-flex justify-content-between ">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'Basic Details' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Legal Business Name :</span>
                                <span>
                                    {{ $form_data->legal_business_name ?? null }}
                                </span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Brand name:</span>
                                <span>
                                    {{ $form_data->brand_name ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Business registration / Establishment Date :</span>
                                <span>
                                    {{ $form_data->business_registration_establishment_date ?? null }}
                                </span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Website and login details :</span>
                                <p>
                                    {{ $form_data->website_login_details ?? null }}
                                </p>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Primary Category :</span>
                                <span>
                                    {{ $form_data->primary_category ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Secondary Category :</span>
                                <span>
                                    {{ $form_data->secondary_category ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Other Categories :</span>
                                <span>
                                    {{ $form_data->other_category ?? null }}
                                </span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Business Description (750 Characters) :</span>
                                <p>
                                    {{ $form_data->business_description ?? null }}
                                </p>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>10 Keywords Related to Business:</span>
                               <p>{{ $form_data->keywords_related_to_business ?? null }}</p>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-12">

                            <h5 class="card-title">
                                <span>Brand Logo:</span>
                                <span>
                                    @if (!empty($form_data->brand_logo))
                                    <img src="{{ asset($form_data->brand_logo) }}" id="preview_brand_logo" alt=""
                                        width="50" height="50">
                                @endif
                                </span>
                            </h5>
                        </div>
                        <hr>


                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'Contact Details' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">


                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Contact Person / Business Owner / Business Manager Name:</span>
                                <span class="">
                                    {{ $form_data->contact_person_business ?? null }}
                                </span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Landline / Primary Contact:</span>
                                <span>
                                    {{ $form_data->landline_primary_contact ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Publishable Contact / Mobile Number:</span>
                                <span>
                                    {{ $form_data->publishable_contact_mobile_number ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>
                                    Official Email Address :</span>
                                <span>
                                    {{ $form_data->official_email_address ?? null }}
                                </span>
                            </h5>
                        </div>

                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Full Business Address :</span>
                                <span class="">
                                    {{ $form_data->full_business_address ?? null }}
                                </span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Address Line 1 :</span>
                                <span class="">{{ $form_data->address_line_1 ?? null }}</span>
                            </h5>
                        </div>
                        <hr>


                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Address Line 2 :</span>
                                <span class="">{{ $form_data->address_line_2 ?? null }}</span>
                            </h5>
                        </div>
                        <hr>


                        <div class="col-3">
                            <h5 class="card-title">
                                <span>City :</span>
                                <span class="">{{ $form_data->city ?? null }}</span>
                            </h5>
                        </div>

                        <div class="col-3">
                            <h5 class="card-title">
                                <span>State :</span>
                                <span class="">{{ $form_data->state ?? null }}</span>
                            </h5>
                        </div>


                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Pincode :</span>
                                <span class="">{{ $form_data->pincode ?? null }}</span>
                            </h5>
                        </div>


                        <div class="col-3">
                            <h5 class="card-title">
                                <span> Do you have multiple locations ?</span>
                                <span class="">{{$form_data->multiple_locations ?? ''}}</span>
                            </h5>
                        </div>



                    </div>

                </div>
            </div>
        </div>



        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ ' TIMINGS' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Working hours (Mon - Fri):</span>
                                <span>
                                    {{ $form_data->working_hours_Mon_to_Fri ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span> Working hours - Saturday :</span>
                                <span>
                                    {{ $form_data->working_hours_saturday ?? null }}
                                </span>
                            </h5>
                        </div>

                        <hr>
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Working hours - Sunday :</span>
                                <span>
                                    {{ $form_data->working_hours_sunday ?? null }}
                                </span>
                            </h5>
                        </div>


                        <div class="col-6">
                            <h5 class="card-title">
                                <span>
                                    Phone Call Timings ( If not same as above ):</span>
                                <span>{{ $form_data->phone_call_timings ?? null }}</span>
                            </h5>
                        </div>


                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ ' Services Details' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Service Location (if different from original):</span>
                                <span>
                                    {{ $form_data->service_location ?? null }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Service timing ( If not same as above ) :</span>
                                <span>
                                    {{ $form_data->service_timing ?? null }}
                                </span>
                            </h5>
                        </div>

                        <hr>
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Services :</span>
                                <span>
                                    {{ $form_data->services ?? null }}
                                </span>
                            </h5>
                        </div>


                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Service Areas :</span>
                                <span>{{ $form_data->service_areas ?? null }} </span>
                            </h5>
                        </div>

                        <hr>
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Any Offers :</span>
                                <span>{{ $form_data->any_offers ?? null }} </span>
                            </h5>
                        </div>


                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Targeted Locations (Cities / States / Countries) :</span>
                                <span>{{ $form_data->targeted_locations ?? null }}</span>
                            </h5>
                        </div>


                    </div>




                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ ' Google Messages (if needed)' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Messaging Enabled :</span>
                                <span>{{$form_data->messaging_enabled ?? ''}}</span>
                            </h5>
                        </div>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Welcome Message :</span>
                                <p>{{ $form_data->welcome_message ?? null }}</p>
                            </h5>
                        </div>

                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>FAQ about business with answers ( 3 - 5 ) :</span>
                                <p>{{ $form_data->faq_about_business_with_answers ?? null }}</p>
                            </h5>
                        </div>
                        <hr>


                    </div>




                </div>
            </div>
        </div>



        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'IMAGES' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Office images :</span>
                                <span>
                                    <img src="{{ $form_data->office_images ?? null }}" alt="" width="70">
                                </span>
                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Exterior :</span>
                                <span>
                                     <img src="{{ $form_data->exterior ?? null }}" alt="" width="70">
                                    </span>
                            </h5>
                        </div>



                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Interior :</span>
                                <span>
                                    <img src="{{ $form_data->interior ?? null }}" alt="" width="70">
                                </span>
                            </h5>
                        </div>



                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Work place :</span>
                              <span>
                                <img src="{{ $form_data->work_place ?? null }}" alt="" width="70">
                              </span>
                            </h5>
                        </div>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Machines :</span>
                               <span>
                                <img src="{{ $form_data->machines ?? null }}" alt="" width="70">
                               </span>
                            </h5>
                        </div>



                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Product / Services Photos ( if any) :</span>
                               <span>
                                <img src="{{ $form_data->product_services_photos ?? null }}" alt=""
                                    width="70">
                               </span>
                            </h5>
                        </div>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Completed work :</span>
                               <span>
                                <img src="{{ $form_data->completed_work ?? null }}" alt="" width="70">
                            </span>
                            </h5>
                        </div>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Local ads images (if any) :</span>
                               <span>
                                <img src="{{ $form_data->local_ads_images ?? null }}" alt="" width="70">
                               </span>
                            </h5>
                        </div>



                    </div>

                </div>


            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'Current Office Related Questions' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Has wheelchair-accessible lift ? :</span>
                                <span>
                                    {{ $form_data->has_wheelchair_accessible_lift ?? null }}
                                </span>
                            </h5>
                        </div><hr>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Has wheelchair-accessible seating ? :</span>
                               <span>{{ $form_data->has_wheelchair_accessible_seating ?? null }}</span>
                            </h5>
                        </div>

                        <hr>

                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Has wheelchair-accessible toilet ? :</span>
                                <span>{{ $form_data->has_wheelchair_accessible_toilet ?? null }}</span>
                            </h5>
                        </div>
                        <hr>


                        <div class="col-12">
                            <h5 class="card-title">
                                <span>Free Wi-Fi ? :</span>
                               <span>{{ $form_data->free_wifi ?? null }}</span>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Appointment required if incase they need to visit? :</span>
                              <span>{{$form_data->appointment_required ?? ''}}</span>
                            </h5>
                        </div>



                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Has electronics recycling ? :</span>
                              <span>{{$form_data->has_electronics_recycling ?? ''}}</span>
                            </h5>
                        </div>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Offers kerbside pickup ? :</span>
                                <span>{{ $form_data->offers_kerbside_pickup ?? '' }}</span>
                            </h5>
                        </div><hr>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>In-store pick-up for online orders ? :</span>
                                <span>{{$form_data->in_store_pickup_online ?? ''}}</span>

                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Has in-store shopping :</span>
                                <span>{{$form_data->has_in_store_shopping ?? ''}}</span>

                            </h5>
                        </div>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Offers same-day delivery :</span>
                                <span>{{$form_data->offers_same_day_delivery ?? ''}}</span>

                            </h5>
                        </div><hr>


                    </div>

                </div>


            </div>
        </div>




        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'Payment Related Questions' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Cash :</span>
                                <span>
                                    {{$form_data->accepts_cash ?? ''}}
                                </span>
                            </h5>
                        </div>

                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Accepts cheques :</span>
                               <span>{{ $form_data->accepts_cheques ?? '' }}</span>
                            </h5>
                        </div>

                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Accepts credit cards :</span>
                                <span>{{  $form_data->accepts_credit_cards ?? '' }}</span>

                            </h5>
                        </div>


                        <div class="col-3">
                            <h5 class="card-title">
                                <span>American Express :</span>
                                <span>{{ $form_data->american_express ?? ''}}</span>

                            </h5>
                        </div>
                        <hr>

                        <div class="col-3">
                            <h5 class="card-title">
                                <span>China Union Pay :</span>
                                <span>{{ $form_data->china_union_pay ?? '' }}</span>

                            </h5>
                        </div>



                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Diners Club :</span>
                                <span>{{ $form_data->diners_club ?? '' }}</span>

                            </h5>
                        </div>


                        <div class="col-3">
                            <h5 class="card-title">
                                <span>Discover :</span>
                                <span>{{ $form_data->discover ?? '' }}</span>

                            </h5>
                        </div>

                        <div class="col-3">
                            <h5 class="card-title">
                                <span>JCB :</span>
                                <span>{{ $form_data->jcb ?? '' }}</span>

                            </h5>
                        </div><hr>


                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Mastercard :</span>
                                <span>{{ $form_data->mastercard ?? '' }}</span>

                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Accepts debit cards :</span>
                                <span>{{ $form_data->accepts_debit_cards ?? '' }}</span>

                            </h5>
                        </div>

                        <div class="col-4">
                            <h5 class="card-title">
                                <span>Accepts NFC mobile payments :</span>
                                <span>{{ $form_data->accepts_nfc_mobile_payments ?? '' }}</span>

                            </h5>
                        </div><hr>


                    </div>

                </div>


            </div>
        </div>




        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header text-danger">{{ 'Social Profile Links' }}</h5>
                <div class="card-body">
                    <div class="row mt-lg-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Facebook :</span>
                               <p>{{ $form_data->facebook ?? null }}</p>
                            </h5>
                        </div>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Instagram :</span>
                                <p>{{ $form_data->instagram ?? null }}</p>
                            </h5>
                        </div><hr>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Twitter :</span>
                                <p>{{ $form_data->twitter ?? null }}</p>
                            </h5>
                        </div>


                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Linkedin :</span>
                                <p>{{ $form_data->linkedin ?? null }}</p>
                            </h5>
                        </div>
                        <hr>

                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Pinterest :</span>
                                <p>{{ $form_data->pinterest ?? null }}</p>
                            </h5>
                        </div>



                        <div class="col-6">
                            <h5 class="card-title">
                                <span>Youtube :</span>
                                <p>{{ $form_data->youtube ?? null }}</p>
                            </h5>
                        </div><hr>


                        <div class="col-12">

                            <h5 class="card-title">
                                <span>Other Social media links :</span>
                                <p>{{ $form_data->other_social_media_links ?? null }}</p>
                            </h5>
                        </div><hr>







                    </div>

                </div>


            </div>
        </div>


    </div>
@endsection

@push('script')
@endpush
