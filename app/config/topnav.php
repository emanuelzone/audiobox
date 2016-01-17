<?php
/**
 * Config-file for navigation bar.
 *
 */


 return [

    // Use for styling the menu
    'class' => 'top-nav',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'login'  => [
            'text'  => '<i class="fa fa-sign-in"></i> Logga in',
            'url'   => $this->di->get('url')->create('login'),
            'title' => 'Logga in',
            'mark-if-parent-of' => 'login'
        ],
 
        // This is a menu item
        'register' => [
            'text'  =>'<i class="fa fa-user-plus"></i> Skapa användare',
            'url'   => $this->di->get('url')->create('register'),
            'title' => 'Register user',
            'mark-if-parent-of' => 'register'
        ],
    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },
];

