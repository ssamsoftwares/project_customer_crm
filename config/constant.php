<?php
return [
    'form_fields' => [
        [
            'label' => 'Legal Business Name',
            'name' => 'legal_business_name',
            'input_type' => 'text',
            'placeholder' => 'Legal Business Name',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Brand Name',
            'name' => 'brand_name',
            'input_type' => 'text',
            'placeholder' => 'Brand Name',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => ' Brand Logo ( Please upload on given link )',
            'name' => 'brand_logo',
            'input_type' => 'file',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Website and login details',
            'name' => 'Website_login_details',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Primary Category',
            'name' => 'primary_category',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Secondary Category',
            'name' => 'secondary_category',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Other Categories',
            'name' => 'other_Categories',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Business Description (750 Characters)',
            'name' => 'business_description',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],


        [
            'label' => '10 Keywords Related to Business',
            'name' => 'keywords_related_to_business',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Contact Person / Business Owner / Business Manager Name',
            'name' => 'contact_Person_Business_owner_business_manager_name',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Landline / Primary Contact',
            'name' => 'landline_primary_contact',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Publishable Contact / Mobile Number',
            'name' => 'publishable_contact_mobile_number',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Official Email Address',
            'name' => 'official_email_address',
            'input_type' => 'email',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Full Business Address',
            'name' => 'full_business_address',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Address Line 1',
            'name' => 'address_line_1',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Address Line 2',
            'name' => 'address_line_2',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'City',
            'name' => 'city',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'State',
            'name' => 'state',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Pincode',
            'name' => 'pincode',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Do you have multiple locations ?',
            'name' => 'multiple_locations',
            'input_type' => 'radio',
            'values' => ["Yes", "No"],
            'required' => true, //false -- boolean
        ],

        // Timings

        [
            'label' => 'Working hours (Mon - Fri)',
            'name' => 'working_hours_Mon_to_Fri)',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Working hours - Saturday',
            'name' => 'working_hours_saturday',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Working hours - Sunday',
            'name' => 'working_hours_sunday',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Phone Call Timings ( If not same as above )',
            'name' => 'phone_call_timings',
            'input_type' => 'text',
            'values' => null,
            'required' => false, //false -- boolean
        ],

        // Services Details
        [
            'label' => 'Service Location (if different from original)',
            'name' => 'service_location',
            'input_type' => 'text',
            'values' => null,
            'required' => false, //false -- boolean
        ],

        [
            'label' => 'Service Timing ( If not same as above )',
            'name' => 'service_timing',
            'input_type' => 'text',
            'values' => null,
            'required' => false, //false -- boolean
        ],

        [
            'label' => 'Services',
            'name' => 'services',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Service Areas',
            'name' => 'service_areas',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],
        [
            'label' => 'Any Offers',
            'name' => 'any_offers',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Targeted Locations (Cities / States / Countries)',
            'name' => 'targeted_locations',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        // Google Messages (if needed)

        [
            'label' => 'Messaging Enabled',
            'name' => 'messaging_enabled',
            'input_type' => 'text',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Welcome Message',
            'name' => 'welcome_message',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'FAQ about business with answers ( 3 - 5 )',
            'name' => 'faq_about_business_with_answers',
            'input_type' => 'textarea',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        // Images

        [
            'label' => 'Office images',
            'name' => 'office_images',
            'input_type' => 'file',
            'values' => null,
            'required' => true, //false -- boolean
        ],

        [
            'label' => 'Exterior',
            'name' => 'exterior',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Interior',
            'name' => 'interior',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Work place',
            'name' => 'work_place',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Machines',
            'name' => 'machines',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Product / Services Photos (if any)',
            'name' => 'product_services_photos',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Completed work',
            'name' => 'completed_work',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        [
            'label' => 'Local ads images (if any)',
            'name' => 'local_ads_images',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],


        [
            'label' => 'Owner / Founder images (1 in a row)',
            'name' => 'owner_founder_images',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],


        [
            'label' => 'Other images',
            'name' => 'other_images',
            'input_type' => 'file',
            'values' => null,
            'required' => false,
        ],

        // Current Office Related Questions
        [
            'label' => 'Has wheelchair-accessible lift',
            'name' => 'has_wheelchair_accessible_lift',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Has wheelchair-accessible seating',
            'name' => 'has_wheelchair_accessible_seating',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Has wheelchair-accessible toilet',
            'name' => 'has_wheelchair_accessible_toilet',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Free Wi-Fi',
            'name' => 'free_wifi',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Appointment required if incase they need to visit?',
            'name' => 'appointment_required',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Has electronics recycling?',
            'name' => 'has_electronics_recycling',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Offers kerbside pickup?',
            'name' => 'offers_kerbside_pickup',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'In-store pick-up for online orders?',
            'name' => 'in_store_pickup',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

            [
            'label' => 'Has in-store shopping?',
            'name' => 'has_in_store_shopping',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

             [
            'label' => 'Offers same-day delivery',
            'name' => 'offers_same_day_delivery',
            'input_type' => 'text',
            'values' => null,
            'required' => false
            ],

            // Payment Related Questions

             [
                'label' => 'Cash',
                'name' => 'accepts_cash',
                'input_type' => 'text',
                'values' => null,
                'required' => false
            ],

             [
                'label' => 'Accepts cheques',
                'name' => 'accepts_cheques',
                'input_type' => 'text',
                'values' => null,
                'required' => false
            ],

             [
                'label' => 'Accepts credit cards',
                'name' => 'accepts_credit_cards',
                'input_type' => 'checkbox',
                'values' => [
                    'American Express',
                    'China Union Pay',
                    'Diners Club',
                    'Discover',
                    'JCB',
                    'Mastercard'
                ],
                'required' => false
            ],

             [
                'label' => 'Accepts debit cards',
                'name' => 'accepts_debit_cards',
                'input_type' => 'text',
                'values' => null,
                'required' => false
            ],

             [
                'label' => 'Accepts NFC mobile payments',
                'name' => 'accepts_nfc_payments',
                'input_type' => 'text',
                'values' => null,
                'required' => false
            ],

            // Social Profile Links

            [
                'label' => 'Facebook(Plase provide account link ,Username,Password)',
                'name' => 'facebook',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],

            [
                'label' => 'Instagram(Plase provide account link ,Username,Password)',
                'name' => 'instagram',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],

            [
                'label' => 'Twitter(Plase provide account link ,Username,Password)',
                'name' => 'twitter',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],

            [
                'label' => 'Linkedin(Plase provide account link ,Username,Password)',
                'name' => 'linkedin',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],

            [
                'label' => 'Pinterest(Plase provide account link ,Username,Password)',
                'name' => 'pinterest',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],

            [
                'label' => 'Youtube(Plase provide account link ,Username,Password)',
                'name' => 'youtube',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],
            [
                'label' => 'Other Social media links',
                'name' => 'other_social_media_links',
                'input_type' => 'textarea',
                'values' => null,
                'required' => false
            ],
    ],
];
