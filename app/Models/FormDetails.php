<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'customer_id',
        'form_name',
        'legal_business_name',
        'brand_name',
        'business_registration_establishment_date',
        'brand_logo',
        'website_login_details',
        'primary_category',
        'secondary_category',
        'other_category',
        'business_description',
        'keywords_related_to_business',
        'contact_person_business',
        'landline_primary_contact',
        'publishable_contact_mobile_number',
        'official_email_address',
        'full_business_address',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pincode',
        'multiple_locations',
        'working_hours_Mon_to_Fri',
        'working_hours_saturday',
        'working_hours_sunday',
        'phone_call_timings',
        'service_location',
        'service_timing',
        'services',
        'service_areas',
        'any_offers',
        'targeted_locations',
        'messaging_enabled',
        'welcome_message',
        'faq_about_business_with_answers',
        'office_images',
        'exterior',
        'interior',
        'work_place',
        'machines',
        'product_services_photos',
        'completed_work',
        'local_ads_images',
        'has_wheelchair_accessible_lift',
        'has_wheelchair_accessible_seating',
        'has_wheelchair_accessible_toilet',
        'free_wifi',
        'appointment_required',
        'has_electronics_recycling',
        'offers_kerbside_pickup',
        'in_store_pickup_online',
        'has_in_store_shopping',
        'offers_same_day_delivery',
        'accepts_cash',
        'accepts_cheques',
        'accepts_credit_cards',
        'american_express',
        'china_union_pay',
        'diners_club',
        'discover',
        'jcb',
        'mastercard',
        'accepts_debit_cards',
        'accepts_nfc_mobile_payments',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'pinterest',
        'youtube',
        'other_social_media_links'
    ];


}
