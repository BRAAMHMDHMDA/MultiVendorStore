<?php

use App\Models\Setting;

return [
    'app' => [
        'title' => 'App Settings',
        'name_menu' => 'App Settings',
        'icon' => 'ti ti-building-store me-2',
        'settings' => [
            'app.name' => [
                'label' => 'App Name',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
            'app.locale' => [
                'label' => 'Default Local Settings',
                'type' => 'select',
                'validate' => 'string',
                'options' => [Setting::class, 'localeOptions']
            ],
            'app.timezone' => [
                'label' => 'Default Timezone',
                'type' => 'select',
                'validate' => 'string',
                'options' => [Setting::class, 'timezoneOptions']
            ],
            'app.currency_default' => [
                'label' => 'Default Currency',
                'type' => 'select',
                'validate' => 'string',
                'options' => [Setting::class, 'currencyOptions']
            ],
            'app.logo' => [
                'label' => 'App Logo',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ],
            'app.logo&name' => [
                'label' => 'App Logo & Name (Full Logo)',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ]
        ],
    ],
    'mail' => [
        'title' => 'Mail Settings',
        'name_menu' => 'Mail Settings',
        'icon' => 'ti ti-mail me-2',
        'settings' => [
            'mail.from.name' => [
                'label' => 'Form Name',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
            'mail.from.address' => [
                'label' => 'Form Address',
                'type' => 'email',
                'validate' => 'email|max:255',
            ],
            'mail.mailers.smtp.host' => [
                'label' => 'Smtp Host',
                'type' => 'string',
                'validate' => 'string',
            ],
            'mail.mailers.smtp.port' => [
                'label' => 'Smtp Port',
                'type' => 'number',
                'validate' => 'int',
            ],
            'mail.mailers.smtp.encryption' => [
                'label' => 'Encryption',
                'type' => 'select',
                'validate' => 'string',
                'options' => ['tls' => 'SSL/TLS', '' => 'Non-SSL']
            ],
            'mail.mailers.smtp.username' => [
                'label' => 'Username',
                'type' => 'text',
                'validate' => 'string',
            ],
            'mail.mailers.smtp.password' => [
                'label' => 'Password',
                'type' => 'password',
                'validate' => 'string',
            ]
        ],
    ],
    'contact' => [
        'title' => 'Contact Info',
        'name_menu' => 'Contact Settings',
        'icon' => 'ti ti-messages me-2',
        'settings' => [
            'contact.phone' => [
                'label' => 'Phone Number',
                'type' => 'text',
                'validate' => 'number|max:255',
            ],
            'contact.telephone' => [
                'label' => 'Telephone',
                'type' => 'text',
                'validate' => 'number|max:255',
            ],
            'contact.email' => [
                'label' => 'Email Address',
                'type' => 'text',
                'validate' => 'email|max:255',
            ],
            'contact.locationAddress' => [
                'label' => 'Location Address',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
        ]
    ],
    'social-media' => [
        'title' => 'Social Media Links',
        'name_menu' => 'Social Media',
        'icon' => 'ti ti-social me-2',
        'settings' => [
            'social.facebook' => [
                'label' => 'facebook Link',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
            'social.twitter' => [
                'label' => 'Twitter Link',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
            'social.linkedin' => [
                'label' => 'Linkedin Link',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],
            'social.instagram' => [
                'label' => 'Instagram Link',
                'type' => 'text',
                'validate' => 'string|max:255',
            ],

        ]
    ],
    'about-us' => [
        'title' => 'About Us',
        'name_menu' => 'About Us',
        'icon' => 'ti ti-thumb-up me-2',
        'settings' => [
            'about.massage1' => [
                'label' => 'Massage 1',
                'type' => 'textarea',
                'validate' => 'string|max:255',
            ],
            'about.massage2' => [
                'label' => 'Massage 2',
                'type' => 'textarea',
                'validate' => 'string|max:255',
            ],
            'about.image' => [
                'label' => 'About Us Image',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ],

        ]
    ],
    'home' => [
        'title' => 'Home',
        'name_menu' => 'Home Page',
        'icon' => 'ti ti-home me-2',
        'settings' => [
            'home.slider1' => [
                'label' => 'Slider Image 1',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ],
            'home.slider2' => [
                'label' => 'Slider Image 2',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ],
            'home.slider3' => [
                'label' => 'Slider Image 3',
                'type' => 'image',
                'src' => '',
                'validate' => 'image',
            ],


        ]
    ],
];