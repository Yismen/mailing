<?php
/**
 * Only super users have access to the admin panel. Provide a string of super user
 * emails separate by comma (,) or pipe(|).
 */
return [
    'super_users' => env('REPORT_SUPER_USERS', 'yismen.jorge@gmail.com'),
    /**
    * Here you can specify a list of middleware to apply to
    * all routes. use "," or "|" to separate the list.
    */
    'midlewares' => [
        'api' => 'api',
        'web' => 'auth',
    ],
    'mailables_dir' => env('REPORT_MAILABLES_DIR', __DIR__ . '/../src/Mail/'),
    'db_prefix' => 'hr_',
    'routes_prefix' => [
        'guest' => 'report',
        'admin' => 'report/admin'
    ],
    'seeds' => [
        'termination_types' => [],
        'termination_reasons' => [],
        'suspension_types' => [],
        'citizenships' => [],
        'departments' => [],
        'payment_types' => [],
    ],
    'layout' => env('LAYOUT_VIEW', 'report::layouts.app')
];
