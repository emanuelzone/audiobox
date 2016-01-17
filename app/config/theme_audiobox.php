<?php
/**
 * Config-file for Audiobox, theme related settings, return it all as array.
 *
 */
return [

    /**
     * Settings for Which theme to use, theme directory is found by path and name.
     *
     * path: where is the base path to the theme directory, end with a slash.
     * name: name of the theme is mapped to a directory right below the path.
     */
    'settings' => [
        'path' => ANAX_INSTALL_PATH . 'theme/',
        'name' => 'audiobox',
    ],

    
    /** 
     * Add default views.
     */
    'views' => [
        ['region' => 'header', 'template' => 'audiobox/header', 'data' => [], 'sort' => -1],
        ['region' => 'footer', 'template' => 'audiobox/footer', 'data' => [], 'sort' => -1],
        [
            'region' => 'navbar', 
            'template' => [
                'callback' => function() {
                    return $this->di->navbar->create();
                },
            ], 
            'data' => [], 
            'sort' => -1
        ],
        [
            'region' => 'topnav', 
            'template' => [
                'callback' => function() {
                    return $this->di->topnav->create();
                },
            ], 
            'data' => [], 
            'sort' => -1
        ],
    ],


    /** 
     * Data to extract and send as variables to the main template file.
     */
    'data' => [

        // Language for this page.
        'lang' => 'sv',

                // Language for this page.
        'siteTagline' => 'sv',

        // Append this value to each <title>
        'title_append' => ' | AUDIOBOX',

        // Stylesheets
        'stylesheets' => ['css/bootstrap.min.css', 'css/audiobox.css', 'css/font-awesome-4.5.0/css/font-awesome.min.css'],

        // Inline style
        'style' => null,

        // Favicon
        'favicon' => 'favicon.ico',

        // Path to modernizr or null to disable
        'modernizr' => 'js/modernizr.js',

        // Path to jquery or null to disable
        'jquery' => '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js',

        // Array with javscript-files to include
        'javascript_include' => ['js/bootstrap.js'],

        // Use google analytics for tracking, set key or null to disable
        'google_analytics' => null,
    ],
];

