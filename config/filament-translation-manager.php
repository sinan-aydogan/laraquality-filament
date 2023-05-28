<?php

return [
    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Application Supported Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the possible locales that can be used.
    | You are free to fill this array with any of the locales which will be
    | supported by the application.
    |
    */
    'supported_locales' => [
        'en',
        'tr',
        'bg',
        'de',
    ],

    /*
    |--------------------------------------------------------------------------
    | Access
    |--------------------------------------------------------------------------
    |
    | Limited = false (default)
    |   Anyone can use the translation manager.
    |
    | Limited = true
    |   The page will use the provided gate to see if the user has access.
    |   - Default Laravel: you can define the gate in a service provider
            (https://laravel.com/docs/9.x/authorization)
    |   - Spatie permissions: set the 'gate' variable to a permission name you want to check against, see the example below.
    |
    |
    */
    'access' => [
        'limited' => false,
        //'gate' => 'view-filament-translation-manager',
    ],

    /*
     |--------------------------------------------------------------------------
     | Ignore Groups
     |--------------------------------------------------------------------------
     |
     | You can list the translation groups that you do not want users to translate.
     | Note: the JSON files are grouped in 'json-file' by default. (see config/laravel-chained-translator.php)
     */
    'ignore_groups' => [
        //        'auth',
    ],

    /*
     |--------------------------------------------------------------------------
     | Navigation Sort
     |--------------------------------------------------------------------------
     |
     | You can specify the order in which navigation items are listed.
     | Accepts integer value according to filamnet documentation.
     | (visit: https://filamentphp.com/docs/2.x/admin/resources/getting-started#sorting-navigation-items)
     */
    'navigation_sort' => null,

    /*
     |--------------------------------------------------------------------------
     | Translation status widget
     |--------------------------------------------------------------------------
     |
     | You can specify the widget settings:
     | - disable the widget
     | - the sort order to decide where it is shown on the dashboard.
     */
    'widget' => [
        'enabled' => true,
        'sort' => 1,
    ],
];
