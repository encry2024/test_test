<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'copyright' => 'Copyright',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'distributors'  =>  [
            'create'    =>  'Create Distributor',
            'edit'      =>  'Edit :distributor',
            'list'      =>  'Distributors',
            'view'      =>  'View :distributor',
            'deleted'   =>  'Deleted Distributors',
            'cart'      =>  'Cart',

            'management'    =>  'Distributor Management',

            'table' =>  [
                'id'                        =>  'ID',
                'name'                      =>  'Company',
                'contact_person_first_name' =>  'First Name',
                'contact_person_last_name'  =>  'Last Name',
                'contact_person_full_name'  =>  'Full Name',
                'contact_number'            =>  'Contact #',
                'email'                     =>  'E-mail',
                'address'                   =>  'Address',
                'created_at'                =>  'Date Created',
                'updated_at'                =>  'Date Updated',
                'deleted_at'                =>  'Date Deleted',
                'total'                     =>  'distributor total|distributors total',
                'queues'                    =>  'Ordered Items on Queue'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview',
                    'products'  =>  'Distributor Products',
                    'cart'      =>  'Product Cart'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'name'                      =>  'Company Name',
                        'contact_person_first_name' =>  'Contact Person First Name',
                        'contact_person_last_name'  =>  'Contact Person Last Name',
                        'email'                     =>  'E-mail',
                        'address'                   =>  'Address',
                        'mobile_number'             =>  'Mobile Number',
                        'telephone_number'          =>  'Telephone Number',
                        'created_at'                =>  'Date Created',
                        'updated_at'                =>  'Date Updated',
                        'deleted_at'                =>  'Date Deleted'
                    ]
                ]
            ],

            'show'  =>  ':distributor'
        ],

        'inventories'  =>  [
            'create'    =>  'Create Item',
            'edit'      =>  'Edit :item',
            'list'      =>  'Item\'s List',
            'view'      =>  'View :item',
            'deleted'   =>  'Deleted Items',

            'management'    =>  'Inventory Management',

            'table' =>  [
                'id'                    =>  'ID',
                'name'                  =>  'Item Name',
                'distributor'           =>  'Distributor',
                'price_per_unit'        =>  'Price/Unit',
                'unit_type'             =>  'Unit Type',
                'stocks'                =>  'Stocks',
                'created_at'            =>  'Date Created',
                'updated_at'            =>  'Date Updated',
                'deleted_at'            =>  'Date Deleted',
                'total'                 =>  'item total|item total',
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'id'                    =>  'ID',
                        'name'                  =>  'Product Name',
                        'distributor'           =>  'Distributor',
                        'price_per_unit'        =>  'Price/Unit',
                        'unit_type'             =>  'Unit Type',
                        'stock'                 =>  'Stocks',
                        'created_at'            =>  'Date Created',
                        'updated_at'            =>  'Date Updated',
                        'deleted_at'            =>  'Date Deleted',
                        'total'                 =>  'inventory total|inventories total',
                    ]
                ]
            ],

            'show'  =>  ':inventory'
        ],

        'clients'  =>  [
            'create'    =>  'Create Client',
            'edit'      =>  'Edit :client',
            'list'      =>  'Client\'s List',
            'view'      =>  'View :client',
            'deleted'   =>  'Deleted Clients',
            'order'     =>  'Client Order',

            'management'    =>  'Client Management',

            'table' =>  [
                'id'                =>  'ID',
                'name'              =>  'Client Name',
                'email'             =>  'E-mail',
                'contact_number'    =>  'Contact Number',
                'address'           =>  'Address',
                'discount'          =>  'Discount',
                'credit_limit'      =>  'Credit Limit',
                'created_at'        =>  'Date Created',
                'updated_at'        =>  'Date Updated',
                'deleted_at'        =>  'Date Deleted',
                'total'             =>  'client total|clients total'
            ],

            'tabs'  =>  [
                'titles'    =>  [
                    'overview'  =>  'Overview'
                ],

                'content'   =>  [
                    'overview'  =>  [
                        'id'                =>  'ID',
                        'name'              =>  'Client Name',
                        'email'             =>  'E-mail',
                        'contact_number'    =>  'Contact Number',
                        'address'           =>  'Address',
                        'discount'          =>  'Discount',
                        'credit_limit'      =>  'Credit Limit',
                        'created_at'        =>  'Date Created',
                        'updated_at'        =>  'Date Updated',
                        'deleted_at'        =>  'Date Deleted',
                    ]
                ]
            ],

            'show'  =>  'Show :client'
        ],

        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'           => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
