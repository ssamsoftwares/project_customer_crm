<?php

namespace App\Http\Controllers;

use App\Models\FormDetails;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

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

        if (!$form_data) {
            abort(404);
        }

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



    public function store(Request $request)
    {
        // dd($request->all());

        DB::beginTransaction();

        try {
            $data = $request->all();
            $formDetails = FormDetails::find($request->id);

            // BRAND LOGO

            if ($request->hasFile('brand_logo')) {
                $brandLogos = $request->file('brand_logo');
                $brandLogoPaths = [];

                foreach ($brandLogos as $brandLogo) {
                    $filename = uniqid() . '.' . $brandLogo->getClientOriginalExtension();
                    $brandLogo->move(public_path('/formDetails/brand_logo/'), $filename);
                    $brandLogoPaths[] = '/formDetails/brand_logo/' . $filename;
                }

                // If updating, delete old images
                if ($formDetails && is_array(json_decode($formDetails->brand_logo))) {
                    foreach (json_decode($formDetails->brand_logo) as $oldBrandLogo) {
                        if (is_file(public_path($oldBrandLogo))) {
                            unlink(public_path($oldBrandLogo));
                        }
                    }
                }

                $data['brand_logo'] = json_encode($brandLogoPaths);
            }




            // OFFICE IMAGE
            if ($request->hasFile('office_images')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->office_images))) {
                    unlink(public_path($formDetails->office_images));
                }

                $officeImages = $request->file('office_images');
                $filename = uniqid() . '.' . $officeImages->getClientOriginalExtension();
                $officeImages->move(public_path('/formDetails/office_images/'), $filename);
                $data['office_images'] = '/formDetails/office_images/' . $filename;
            }

            // EXTERIOR IMAGE

            if ($request->hasFile('exterior')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->exterior))) {
                    unlink(public_path($formDetails->exterior));
                }

                $exterior = $request->file('exterior');
                $filename = uniqid() . '.' . $exterior->getClientOriginalExtension();
                $exterior->move(public_path('/formDetails/exterior/'), $filename);
                $data['exterior'] = '/formDetails/exterior/' . $filename;
            }

            // INTERRIOR IMAGE
            if ($request->hasFile('interior')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->interior))) {
                    unlink(public_path($formDetails->interior));
                }

                $interior = $request->file('interior');
                $filename = uniqid() . '.' . $interior->getClientOriginalExtension();
                $interior->move(public_path('/formDetails/interior/'), $filename);
                $data['interior'] = '/formDetails/interior/' . $filename;
            }

            // WORK PLACE IMAGE
            if ($request->hasFile('work_place')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->work_place))) {
                    unlink(public_path($formDetails->work_place));
                }

                $work_place = $request->file('work_place');
                $filename = uniqid() . '.' . $work_place->getClientOriginalExtension();
                $work_place->move(public_path('/formDetails/work_place/'), $filename);
                $data['work_place'] = '/formDetails/work_place/' . $filename;
            }

            // MACHINES IMAGE
            if ($request->hasFile('machines')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->machines))) {
                    unlink(public_path($formDetails->machines));
                }

                $machines = $request->file('machines');
                $filename = uniqid() . '.' . $machines->getClientOriginalExtension();
                $machines->move(public_path('/formDetails/machines/'), $filename);
                $data['machines'] = '/formDetails/machines/' . $filename;
            }

            // Product / Services IMAGE
            if ($request->hasFile('product_services_photos')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->product_services_photos))) {
                    unlink(public_path($formDetails->product_services_photos));
                }

                $product_services_photos = $request->file('product_services_photos');
                $filename = uniqid() . '.' . $product_services_photos->getClientOriginalExtension();
                $product_services_photos->move(public_path('/formDetails/product_services_photos/'), $filename);
                $data['product_services_photos'] = '/formDetails/product_services_photos/' . $filename;
            }

            // COMPLETED WORK IMAGE
            if ($request->hasFile('completed_work')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->completed_work))) {
                    unlink(public_path($formDetails->completed_work));
                }

                $completed_work = $request->file('completed_work');
                $filename = uniqid() . '.' . $completed_work->getClientOriginalExtension();
                $completed_work->move(public_path('/formDetails/completed_work/'), $filename);
                $data['completed_work'] = '/formDetails/completed_work/' . $filename;
            }

            // LOCAL ADS IMAGES
            if ($request->hasFile('local_ads_images')) {
                // Delete the old image if it exists for update
                if ($formDetails && is_file(public_path($formDetails->local_ads_images))) {
                    unlink(public_path($formDetails->local_ads_images));
                }

                $local_ads_images = $request->file('local_ads_images');
                $filename = uniqid() . '.' . $local_ads_images->getClientOriginalExtension();
                $local_ads_images->move(public_path('/formDetails/local_ads_images/'), $filename);
                $data['local_ads_images'] = '/formDetails/local_ads_images/' . $filename;
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



    public function viewCustomerGetDetailsForm($c_id = null, $p_id = null)
    {
        $customer = User::find($c_id);

        $data = $this->getFormData($c_id, $p_id);
        $project = $data['project'];
        $form_data = $data['form_data'];

        return view('superadmin.form_details.view', compact('customer', 'project', 'form_data'));
    }
}
