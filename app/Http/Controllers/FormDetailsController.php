<?php

namespace App\Http\Controllers;

use App\Models\FormDetails;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FormDetailsController extends Controller
{

    public function preview()
    {
        return view('superadmin.form_details.add');
    }



    private function getFormData($c_id, $p_id)
    {
        $project = Project::find($p_id);

        if (!$project || !$project->form_name) {
            abort(404);
        }

        $form_data = FormDetails::where(['customer_id' => $c_id, 'project_id' => $p_id, 'form_name' => $project->form_name . '_p_' . $project->id])->first();

        // if (!$form_data) {
        //     abort(404);
        // }

        return ['project' => $project, 'form_data' => $form_data];
    }


    public function create($c_id = null, $p_id = null)
    {
        $customer = User::find($c_id);

        $data = $this->getFormData($c_id, $p_id);
        $project = $data['project'];
        $form_data = $data['form_data'];

        return view('superadmin.form_details.add', compact('customer', 'project', 'form_data'));
    }


    // public function store(Request $request)
    // {
    //     // dd($request->all());

    //     DB::beginTransaction();

    //     try {
    //         $data = $request->all();
    //         $formDetails = FormDetails::find($request->id);

    //         // BRAND LOGO
    //         if ($request->hasFile('brand_logo')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->brand_logo))) {
    //                 unlink(public_path($formDetails->brand_logo));
    //             }

    //             $brandLogo = $request->file('brand_logo');
    //             $filename = uniqid() . '.' . $brandLogo->getClientOriginalExtension();
    //             $brandLogo->move(public_path('/formDetails/brand_logo/'), $filename);
    //             $data['brand_logo'] = '/formDetails/brand_logo/' . $filename;
    //         }

    //         // OFFICE IMAGE
    //         if ($request->hasFile('office_images')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->office_images))) {
    //                 unlink(public_path($formDetails->office_images));
    //             }

    //             $officeImages = $request->file('office_images');
    //             $filename = uniqid() . '.' . $officeImages->getClientOriginalExtension();
    //             $officeImages->move(public_path('/formDetails/office_images/'), $filename);
    //             $data['office_images'] = '/formDetails/office_images/' . $filename;
    //         }

    //         // EXTERIOR IMAGE

    //         if ($request->hasFile('exterior')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->exterior))) {
    //                 unlink(public_path($formDetails->exterior));
    //             }

    //             $exterior = $request->file('exterior');
    //             $filename = uniqid() . '.' . $exterior->getClientOriginalExtension();
    //             $exterior->move(public_path('/formDetails/exterior/'), $filename);
    //             $data['exterior'] = '/formDetails/exterior/' . $filename;
    //         }

    //         // INTERRIOR IMAGE
    //         if ($request->hasFile('interior')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->interior))) {
    //                 unlink(public_path($formDetails->interior));
    //             }

    //             $interior = $request->file('interior');
    //             $filename = uniqid() . '.' . $interior->getClientOriginalExtension();
    //             $interior->move(public_path('/formDetails/interior/'), $filename);
    //             $data['interior'] = '/formDetails/interior/' . $filename;
    //         }

    //         // WORK PLACE IMAGE
    //         if ($request->hasFile('work_place')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->work_place))) {
    //                 unlink(public_path($formDetails->work_place));
    //             }

    //             $work_place = $request->file('work_place');
    //             $filename = uniqid() . '.' . $work_place->getClientOriginalExtension();
    //             $work_place->move(public_path('/formDetails/work_place/'), $filename);
    //             $data['work_place'] = '/formDetails/work_place/' . $filename;
    //         }

    //         // MACHINES IMAGE
    //         if ($request->hasFile('machines')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->machines))) {
    //                 unlink(public_path($formDetails->machines));
    //             }

    //             $machines = $request->file('machines');
    //             $filename = uniqid() . '.' . $machines->getClientOriginalExtension();
    //             $machines->move(public_path('/formDetails/machines/'), $filename);
    //             $data['machines'] = '/formDetails/machines/' . $filename;
    //         }

    //         // Product / Services IMAGE
    //         if ($request->hasFile('product_services_photos')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->product_services_photos))) {
    //                 unlink(public_path($formDetails->product_services_photos));
    //             }

    //             $product_services_photos = $request->file('product_services_photos');
    //             $filename = uniqid() . '.' . $product_services_photos->getClientOriginalExtension();
    //             $product_services_photos->move(public_path('/formDetails/product_services_photos/'), $filename);
    //             $data['product_services_photos'] = '/formDetails/product_services_photos/' . $filename;
    //         }

    //         // COMPLETED WORK IMAGE
    //         if ($request->hasFile('completed_work')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->completed_work))) {
    //                 unlink(public_path($formDetails->completed_work));
    //             }

    //             $completed_work = $request->file('completed_work');
    //             $filename = uniqid() . '.' . $completed_work->getClientOriginalExtension();
    //             $completed_work->move(public_path('/formDetails/completed_work/'), $filename);
    //             $data['completed_work'] = '/formDetails/completed_work/' . $filename;
    //         }

    //         // LOCAL ADS IMAGES
    //         if ($request->hasFile('local_ads_images')) {
    //             // Delete the old image if it exists for update
    //             if ($formDetails && is_file(public_path($formDetails->local_ads_images))) {
    //                 unlink(public_path($formDetails->local_ads_images));
    //             }

    //             $local_ads_images = $request->file('local_ads_images');
    //             $filename = uniqid() . '.' . $local_ads_images->getClientOriginalExtension();
    //             $local_ads_images->move(public_path('/formDetails/local_ads_images/'), $filename);
    //             $data['local_ads_images'] = '/formDetails/local_ads_images/' . $filename;
    //         }


    //         if ($formDetails) {
    //             $formDetails->update($data);
    //         } else {
    //             FormDetails::create($data);
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->with('status', $e->getMessage());
    //     }

    //     DB::commit();
    //     return Redirect::back()->with('status', 'Form Details Saved Successfully !');
    // }



    // public function store(Request $request)
    // {
    //     // dd($request->all());

    //     DB::beginTransaction();

    //     try {
    //         $data = $request->all();
    //         $formDetails = FormDetails::find($request->id);

    //         // BRAND LOGO

    //         if ($request->hasFile('brand_logo')) {
    //             $brandLogos = $request->file('brand_logo');
    //             $brandLogoPaths = [];

    //             foreach ($brandLogos as $brandLogo) {
    //                 $filename = uniqid() . '.' . $brandLogo->getClientOriginalExtension();
    //                 $brandLogo->move(public_path('/formDetails/brand_logo/'), $filename);
    //                 $brandLogoPaths[] = '/formDetails/brand_logo/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->brand_logo))) {
    //                 foreach (json_decode($formDetails->brand_logo) as $oldBrandLogo) {
    //                     if (is_file(public_path($oldBrandLogo))) {
    //                         unlink(public_path($oldBrandLogo));
    //                     }
    //                 }
    //             }

    //             $data['brand_logo'] = json_encode($brandLogoPaths);
    //         }


    //         // OFFICE IMAGE
    //         if ($reqImg = $request->file('office_images')) {
    //             $destination = "/formDetails/office_images/";
    //             $oldImages = json_decode($formDetails->office_images);

    //             foreach ($reqImg as $img) {

    //                 $rand = Str::random(5);
    //                 $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
    //                 $img->move(public_path() . $destination, $imgName);
    //                 $imageData[] = '/formDetails/office_images/' . $imgName;
    //             }
    //             $allimgs = array_merge($oldImages, $imageData);
    //             $data['office_images'] = json_encode($allimgs);
    //         }



    //         // if ($request->hasFile('office_images')) {
    //         //     $officeImg = $request->file('office_images');
    //         //     $officeImgPaths = [];

    //         //     // If updating, delete old images
    //         //     // if ($formDetails && is_array(json_decode($formDetails->office_images))) {
    //         //     //     foreach (json_decode($formDetails->office_images) as $oldOfficeImg) {
    //         //     //         // if (is_file(public_path($oldOfficeImg))) {
    //         //     //         //     unlink(public_path($oldOfficeImg));
    //         //     //         // }
    //         //     //     }
    //         //     // }

    //         //     foreach ($officeImg as $of_img) {
    //         //         $filename = uniqid() . '.' . $of_img->getClientOriginalExtension();
    //         //         $of_img->move(public_path('/formDetails/office_images/'), $filename);
    //         //         $officeImgPaths[] = '/formDetails/office_images/' . $filename;
    //         //     }

    //         //     $data['office_images'] = json_encode($officeImgPaths);
    //         // }



    //         // EXTERIOR IMAGE

    //         if ($request->hasFile('exterior')) {
    //             $exterior = $request->file('exterior');
    //             $exteriorPaths = [];

    //             foreach ($exterior as $ex_img) {
    //                 $filename = uniqid() . '.' . $ex_img->getClientOriginalExtension();
    //                 $ex_img->move(public_path('/formDetails/exterior/'), $filename);
    //                 $exteriorPaths[] = '/formDetails/exterior/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->exterior))) {
    //                 foreach (json_decode($formDetails->exterior) as $oldexterior) {
    //                     if (is_file(public_path($oldexterior))) {
    //                         unlink(public_path($oldexterior));
    //                     }
    //                 }
    //             }

    //             $data['exterior'] = json_encode($exteriorPaths);
    //         }


    //         // INTERRIOR IMAGE

    //         if ($request->hasFile('interior')) {
    //             $interior = $request->file('interior');
    //             $interiorPaths = [];

    //             foreach ($interior as $interior_img) {
    //                 $filename = uniqid() . '.' . $interior_img->getClientOriginalExtension();
    //                 $interior_img->move(public_path('/formDetails/interior/'), $filename);
    //                 $interiorPaths[] = '/formDetails/interior/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->interior))) {
    //                 foreach (json_decode($formDetails->interior) as $oldinterior) {
    //                     if (is_file(public_path($oldinterior))) {
    //                         unlink(public_path($oldinterior));
    //                     }
    //                 }
    //             }

    //             $data['interior'] = json_encode($interiorPaths);
    //         }


    //         // WORK PLACE IMAGE

    //         if ($request->hasFile('work_place')) {
    //             $workPlace = $request->file('work_place');
    //             $work_placePaths = [];

    //             foreach ($workPlace as $work_place_img) {
    //                 $filename = uniqid() . '.' . $work_place_img->getClientOriginalExtension();
    //                 $work_place_img->move(public_path('/formDetails/work_place/'), $filename);
    //                 $work_placePaths[] = '/formDetails/work_place/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->work_place))) {
    //                 foreach (json_decode($formDetails->work_place) as $oldwork_place) {
    //                     if (is_file(public_path($oldwork_place))) {
    //                         unlink(public_path($oldwork_place));
    //                     }
    //                 }
    //             }

    //             $data['work_place'] = json_encode($work_placePaths);
    //         }


    //         // MACHINES IMAGE

    //         if ($request->hasFile('machines')) {
    //             $machines = $request->file('machines');
    //             $machinesPaths = [];

    //             foreach ($machines as $machines_img) {
    //                 $filename = uniqid() . '.' . $machines_img->getClientOriginalExtension();
    //                 $machines_img->move(public_path('/formDetails/machines/'), $filename);
    //                 $machinesPaths[] = '/formDetails/machines/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->machines))) {
    //                 foreach (json_decode($formDetails->machines) as $oldMachines) {
    //                     if (is_file(public_path($oldMachines))) {
    //                         unlink(public_path($oldMachines));
    //                     }
    //                 }
    //             }

    //             $data['machines'] = json_encode($machinesPaths);
    //         }


    //         // Product / Services IMAGE

    //         if ($request->hasFile('product_services_photos')) {
    //             $product_services = $request->file('product_services_photos');
    //             $productServicePaths = [];

    //             foreach ($product_services as $service_img) {
    //                 $filename = uniqid() . '.' . $service_img->getClientOriginalExtension();
    //                 $service_img->move(public_path('/formDetails/product_services_photos/'), $filename);
    //                 $productServicePaths[] = '/formDetails/product_services_photos/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->product_services_photos))) {
    //                 foreach (json_decode($formDetails->product_services_photos) as $oldProductService) {
    //                     if (is_file(public_path($oldProductService))) {
    //                         unlink(public_path($oldProductService));
    //                     }
    //                 }
    //             }

    //             $data['product_services_photos'] = json_encode($productServicePaths);
    //         }


    //         // COMPLETED WORK IMAGE

    //         if ($request->hasFile('completed_work')) {
    //             $completed_work = $request->file('completed_work');
    //             $completedWorkPaths = [];

    //             foreach ($completed_work as $work_img) {
    //                 $filename = uniqid() . '.' . $work_img->getClientOriginalExtension();
    //                 $work_img->move(public_path('/formDetails/completed_work/'), $filename);
    //                 $completedWorkPaths[] = '/formDetails/completed_work/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->completed_work))) {
    //                 foreach (json_decode($formDetails->completed_work) as $oldcompletedWork) {
    //                     if (is_file(public_path($oldcompletedWork))) {
    //                         unlink(public_path($oldcompletedWork));
    //                     }
    //                 }
    //             }

    //             $data['completed_work'] = json_encode($completedWorkPaths);
    //         }


    //         // LOCAL ADS IMAGES

    //         if ($request->hasFile('local_ads_images')) {
    //             $local_ads_images = $request->file('local_ads_images');
    //             $localAdsImgPaths = [];

    //             foreach ($local_ads_images as $local_img) {
    //                 $filename = uniqid() . '.' . $local_img->getClientOriginalExtension();
    //                 $local_img->move(public_path('/formDetails/local_ads_images/'), $filename);
    //                 $localAdsImgPaths[] = '/formDetails/local_ads_images/' . $filename;
    //             }

    //             // If updating, delete old images
    //             if ($formDetails && is_array(json_decode($formDetails->local_ads_images))) {
    //                 foreach (json_decode($formDetails->local_ads_images) as $oldLocalImg) {
    //                     if (is_file(public_path($oldLocalImg))) {
    //                         unlink(public_path($oldLocalImg));
    //                     }
    //                 }
    //             }

    //             $data['local_ads_images'] = json_encode($localAdsImgPaths);
    //         }

    //         if ($formDetails) {
    //             $formDetails->update($data);
    //         } else {
    //             FormDetails::create($data);
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->with('status', $e->getMessage());
    //     }

    //     DB::commit();
    //     return Redirect::back()->with('status', 'Form Details Saved Successfully !');
    // }



    public function store(Request $request)
    {
        $this->validate($request, [
            'legal_business_name' => 'required',
            'brand_name' => 'required',
            'brand_logo.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'office_images.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'exterior.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'interior.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'work_place.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'machines.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'product_services_photos.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'completed_work.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'completed_work.*' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'local_ads_images' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        DB::beginTransaction();

        try {


            $data = [
                'project_id' => $request->project_id,
                'customer_id' => $request->customer_id,
                'form_name' => $request->form_name,
                'legal_business_name' => $request->legal_business_name,
                'brand_name' => $request->brand_name,
                'business_registration_establishment_date' => $request->business_registration_establishment_date,
                // 'brand_logo' => $request->brand_logo,
                'website_login_details' => $request->website_login_details,
                'primary_category' => $request->primary_category,
                'secondary_category' => $request->secondary_category,
                'other_category' => $request->other_category,
                'business_description' => $request->business_description,
                'keywords_related_to_business' => $request->keywords_related_to_business,
                'contact_person_business' => $request->contact_person_business,
                'landline_primary_contact' => $request->landline_primary_contact,
                'publishable_contact_mobile_number' => $request->publishable_contact_mobile_number,
                'official_email_address' => $request->official_email_address,
                'full_business_address' => $request->full_business_address,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'multiple_locations' => $request->multiple_locations,
                'working_hours_Mon_to_Fri' => $request->working_hours_Mon_to_Fri,
                'working_hours_saturday' => $request->working_hours_saturday,
                'working_hours_sunday' => $request->working_hours_sunday,
                'phone_call_timings' => $request->phone_call_timings,
                'service_location' => $request->service_location,
                'service_timing' => $request->service_timing,
                'services' => $request->services,
                'service_areas' => $request->service_areas,
                'any_offers' => $request->any_offers,
                'targeted_locations' => $request->targeted_locations,
                'messaging_enabled' => $request->messaging_enabled,
                'welcome_message' => $request->welcome_message,
                'faq_about_business_with_answers' => $request->faq_about_business_with_answers,
                // 'office_images' => $request->office_images,
                // 'exterior' => $request->exterior,
                // 'interior' => $request->interior,
                // 'work_place' => $request->work_place,
                // 'machines' => $request->machines,
                // 'product_services_photos' => $request->product_services_photos,
                // 'completed_work' => $request->completed_work,
                // 'local_ads_images' => $request->local_ads_images,
                'has_wheelchair_accessible_lift' => $request->has_wheelchair_accessible_lift,
                'has_wheelchair_accessible_seating' => $request->has_wheelchair_accessible_seating,
                'has_wheelchair_accessible_toilet' => $request->has_wheelchair_accessible_toilet,
                'free_wifi' => $request->free_wifi,
                'appointment_required' => $request->appointment_required,
                'has_electronics_recycling' => $request->has_electronics_recycling,
                'offers_kerbside_pickup' => $request->offers_kerbside_pickup,
                'in_store_pickup_online' => $request->in_store_pickup_online,
                'has_in_store_shopping' => $request->has_in_store_shopping,
                'offers_same_day_delivery' => $request->offers_same_day_delivery,
                'accepts_cash' => $request->accepts_cash,
                'accepts_cheques' => $request->accepts_cheques,
                'accepts_credit_cards' => $request->accepts_credit_cards,
                'american_express' => $request->american_express,
                'china_union_pay' => $request->china_union_pay,
                'diners_club' => $request->diners_club,
                'discover' => $request->discover,
                'jcb' => $request->jcb,
                'mastercard' => $request->mastercard,
                'accepts_debit_cards' => $request->accepts_debit_cards,
                'accepts_nfc_mobile_payments' => $request->accepts_nfc_mobile_payments,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'pinterest' => $request->pinterest,
                'youtube' => $request->youtube,
                'other_social_media_links' => $request->other_social_media_links,
            ];

            $formDetails = FormDetails::find($request->id);

            // BRAND LOGO

            // if ($brandLogireqImg = $request->file('brand_logo')) {
            //     $destination = "/formDetails/brand_logo/";
            //     $oldImages = json_decode($formDetails->brand_logo);

            //     foreach ($brandLogireqImg as $img) {

            //         $rand = Str::random(5);
            //         $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
            //         $img->move(public_path() . $destination, $imgName);
            //         $imageData[] = '/formDetails/brand_logo/' . $imgName;
            //     }
            //     $allimgs = array_merge($oldImages, $imageData);
            //     $data['brand_logo'] = json_encode($allimgs);
            // }

            if ($brandLogireqImg = $request->file('brand_logo')) {
                $destination = "/formDetails/brand_logo/";

                $oldImages = json_decode($formDetails->brand_logo) ?? [];

                $imageData = [];

                foreach ($brandLogireqImg as $img) {
                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/brand_logo/' . $imgName;
                }

                // Merge old and new image paths
                $allimgs = array_merge($oldImages, $imageData);

                // Encode merged image paths into JSON
                $data['brand_logo'] = json_encode($allimgs);
            }


            // OFFICE IMAGE
            if ($reqImg = $request->file('office_images')) {
                $destination = "/formDetails/office_images/";
                $oldImages = json_decode($formDetails->office_images) ?? [];

                $imageData = [];

                foreach ($reqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/office_images/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['office_images'] = json_encode($allimgs);
            }


            // EXTERIOR IMAGE
            if ($exteriorReqImg = $request->file('exterior')) {
                $destination = "/formDetails/exterior/";

                $oldImages = json_decode($formDetails->exterior) ?? [];

                $imageData = [];

                foreach ($exteriorReqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/exterior/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['exterior'] = json_encode($allimgs);
            }



            // INTERRIOR IMAGE

            if ($interiorReqImg = $request->file('interior')) {
                $destination = "/formDetails/interior/";
                $oldImages = json_decode($formDetails->interior) ?? [];

                $imageData = [];

                foreach ($interiorReqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/interior/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['interior'] = json_encode($allimgs);
            }


            // WORK PLACE IMAGE

            if ($work_placeReqImg = $request->file('work_place')) {
                $destination = "/formDetails/work_place/";
                $oldImages = json_decode($formDetails->work_place) ?? [];

                $imageData = [];

                foreach ($work_placeReqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/work_place/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['work_place'] = json_encode($allimgs);
            }


            // MACHINES IMAGE

            if ($machinesReqImg = $request->file('machines')) {
                $destination = "/formDetails/machines/";
                $oldImages = json_decode($formDetails->machines) ?? [];

                $imageData = [];

                foreach ($machinesReqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/machines/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['machines'] = json_encode($allimgs);
            }

            // Product / Services IMAGE


            if ($serviceReqImg = $request->file('product_services_photos')) {
                $destination = "/formDetails/product_services_photos/";
                $oldImages = json_decode($formDetails->product_services_photos) ?? [];

                $imageData = [];

                foreach ($serviceReqImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/product_services_photos/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['product_services_photos'] = json_encode($allimgs);
            }


            // COMPLETED WORK IMAGE

            if ($wrkImg = $request->file('completed_work')) {
                $destination = "/formDetails/completed_work/";
                $oldImages = json_decode($formDetails->completed_work) ?? [];

                $imageData = [];

                foreach ($wrkImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/completed_work/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['completed_work'] = json_encode($allimgs);
            }

            // LOCAL ADS IMAGES


            if ($reqLocalImg = $request->file('local_ads_images')) {
                $destination = "/formDetails/local_ads_images/";
                $oldImages = json_decode($formDetails->local_ads_images) ?? [];

                $imageData = [];

                foreach ($reqLocalImg as $img) {

                    $rand = Str::random(5);
                    $imgName = $rand . '-' . time() . '-' . $img->getClientOriginalName();
                    $img->move(public_path() . $destination, $imgName);
                    $imageData[] = '/formDetails/local_ads_images/' . $imgName;
                }
                $allimgs = array_merge($oldImages, $imageData);
                $data['local_ads_images'] = json_encode($allimgs);
            }


            if ($formDetails) {
                $formDetails->update($data);
            } else {
                FormDetails::create($data);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }

        DB::commit();
        return Redirect::back()->with('status', 'Form Details Saved Successfully !');
    }













    // Brand Logo Edit Time Delete Image Function
    public function formUpdateTimeDeleteBrandLogo(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->brand_logo) {
            $oldImages = json_decode($deleteIMG->brand_logo, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->brand_logo = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    // Office Image Edit Time Delete Image Function
    public function formUpdateTimeDeleteOfficeImg(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->office_images) {
            $oldImages = json_decode($deleteIMG->office_images, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->office_images = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    // EXTERIOR Edit Time Delete Image Function
    public function formUpdateTimeDeleteExterior(Request $request, FormDetails $formDetails)
    {
        $exteriordeleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->exterior) {
            $oldImages = json_decode($exteriordeleteIMG->exterior, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $exteriordeleteIMG->exterior = json_encode($newArr);
                    $exteriordeleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    // INTERRIOR Edit Time Delete Image Function
    public function formUpdateTimeDeleteInterior(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->interior) {
            $oldImages = json_decode($deleteIMG->interior, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->interior = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    //  WORK PLACE Edit Time Delete Image Function
    public function formUpdateTimeDeleteWorkPlace(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->work_place) {
            $oldImages = json_decode($deleteIMG->work_place, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->work_place = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    //   MACHINES Edit Time Delete Image Function
    public function formUpdateTimeDeleteMachines(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->machines) {
            $oldImages = json_decode($deleteIMG->machines, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->machines = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    //   Product / Services IMAGE Edit Time Delete Image Function
    public function formUpdateTimeDeleteServiceImg(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->product_services_photos) {
            $oldImages = json_decode($deleteIMG->product_services_photos, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->product_services_photos = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }


    //   COMPLETED WORK IMAGE Edit Time Delete Image Function
    public function formUpdateTimeDeleteCompletWrk(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->completed_work) {
            $oldImages = json_decode($deleteIMG->completed_work, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->completed_work = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }




    //   LOCAL ADS IMAGES Edit Time Delete Image Function
    public function formUpdateTimeDeleteLocalAdsImg(Request $request, FormDetails $formDetails)
    {
        $deleteIMG = FormDetails::find($request->id);
        if ($reqImg = $request->local_ads_images) {
            $oldImages = json_decode($deleteIMG->local_ads_images, true);

            // Delete Image on folder
            if (!empty($oldImages)) {
                $deleted = false;
                foreach ($oldImages as $key => $oldImage) {
                    if ($oldImage === $reqImg) {
                        // Delete the selected image from the storage folder
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                        // Remove the image from the array
                        unset($oldImages[$key]);
                        $deleted = true;
                    }
                }

                if ($deleted) {
                    $newArr = array_values($oldImages);
                    $deleteIMG->local_ads_images = json_encode($newArr);
                    $deleteIMG->update();
                    return response()->json(["msg" => 'success']);
                }
            }
        }
    }



    public function viewCustomerGetDetailsForm($c_id = null, $p_id = null)
    {
        $customer = User::find($c_id);

        $data = $this->getFormData($c_id, $p_id);
        $project = $data['project'];
        $form_data = $data['form_data'];

        return view('superadmin.form_details.view', compact('customer', 'project', 'form_data'));
    }
}
