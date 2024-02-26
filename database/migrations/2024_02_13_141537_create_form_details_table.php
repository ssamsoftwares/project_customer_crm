<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('form_name');
            // Basic details
            $table->string('legal_business_name');
            $table->string('brand_name');
            $table->date('business_registration_establishment_date')->nullable();
            $table->string('brand_logo')->nullable();
            $table->longText('website_login_details')->nullable();
            $table->string('primary_category')->nullable();
            $table->string('secondary_category')->nullable();
            $table->string('other_category')->nullable();
            $table->longText('business_description')->nullable();
            $table->longText('keywords_related_to_business')->nullable();

            // Contact details
            $table->longText('contact_person_business')->nullable();
            $table->string('landline_primary_contact')->nullable();
            $table->string('publishable_contact_mobile_number')->nullable();
            $table->string('official_email_address')->nullable();
            $table->longText('full_business_address')->nullable();
            $table->longText('address_line_1')->nullable();
            $table->longText('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->enum('multiple_locations', ['yes', 'no'])->nullable();

            // Timings

            $table->string('working_hours_Mon_to_Fri')->nullable();
            $table->string('working_hours_saturday')->nullable();
            $table->string('working_hours_sunday')->nullable();
            $table->string('phone_call_timings')->nullable();

            // Services Details
            $table->string('service_location')->nullable();
            $table->string('service_timing')->nullable();
            $table->string('services')->nullable();
            $table->string('service_areas')->nullable();
            $table->string('any_offers')->nullable();
            $table->string('targeted_locations')->nullable();

            // Google Messages
            $table->enum('messaging_enabled', ['yes', 'no'])->nullable();
            $table->longText('welcome_message')->nullable();
            $table->longText('faq_about_business_with_answers')->nullable();

            // Images
            $table->longText('office_images')->nullable();
            $table->longText('exterior')->nullable();
            $table->longText('interior')->nullable();
            $table->longText('work_place')->nullable();
            $table->longText('machines')->nullable();
            $table->longText('product_services_photos')->nullable();
            $table->longText('completed_work')->nullable();
            $table->longText('local_ads_images')->nullable();

            // Current Office Related Questions
            $table->string('has_wheelchair_accessible_lift')->nullable();
            $table->string('has_wheelchair_accessible_seating')->nullable();
            $table->string('has_wheelchair_accessible_toilet')->nullable();
            $table->string('free_wifi')->nullable();
            $table->enum('appointment_required', ['yes', 'no'])->nullable();
            $table->enum('has_electronics_recycling', ['yes', 'no'])->nullable();
            $table->enum('offers_kerbside_pickup', ['yes', 'no'])->nullable();
            $table->enum('in_store_pickup_online', ['yes', 'no'])->nullable();
            $table->enum('has_in_store_shopping', ['yes', 'no'])->nullable();
            $table->enum('offers_same_day_delivery', ['yes', 'no'])->nullable();

            // Payment Related Questions
            $table->enum('accepts_cash', ['yes', 'no'])->nullable();
            $table->enum('accepts_cheques', ['yes', 'no'])->nullable();
            $table->enum('accepts_credit_cards', ['yes', 'no'])->nullable();
            $table->enum('american_express', ['yes', 'no'])->nullable();
            $table->enum('china_union_pay', ['yes', 'no'])->nullable();
            $table->enum('diners_club', ['yes', 'no'])->nullable();
            $table->enum('discover', ['yes', 'no'])->nullable();
            $table->enum('jcb', ['yes', 'no'])->nullable();
            $table->enum('mastercard', ['yes', 'no'])->nullable();
            $table->enum('accepts_debit_cards', ['yes', 'no'])->nullable();
            $table->enum('accepts_nfc_mobile_payments', ['yes', 'no'])->nullable();

            // Social Profile Links
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('youtube')->nullable();
            $table->text('other_social_media_links')->nullable();


            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_details');
    }
};
