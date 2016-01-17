<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar main-nav',
 
    // Here comes the menu strcture
    'items' => [
	
	        // This is a menu item
        'start'  => [
            'text'  => '<i class="fa fa-home"></i> Start',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Welcome',
            'mark-if-parent-of' => 'start',
        ],

        // This is a menu item
        'question'  => [
            'text'  => '<i class="fa fa-question-circle"></i> Frågor',
            'url'   => $this->di->get('url')->create('questions/list'),
            'title' => 'All questions',
            'mark-if-parent-of' => 'frågor',
        ],
 
        // This is a menu item
        'tag' => [
            'text'  =>'<i class="fa fa-tags"></i> Taggar',
            'url'   => $this->di->get('url')->create('tags/list'),
            'title' => 'All tags',
            'mark-if-parent-of' => 'taggar',
        ],

        // This is a menu item
        'user' => [
            'text'  =>'<i class="fa fa-users"></i> Användare',
            'url'   => $this->di->get('url')->create('user/list'),
            'title' => 'All users',
            'mark-if-parent-of' => 'användare',

					], 

                    

        // This is a menu item
        'about' => [
            'text'  =>'<i class="fa fa-info-circle"></i> Om oss',
            'url'   => $this->di->get('url')->create('about'),
            'title' => 'About us',
			'mark-if-parent-of' => 'om oss',
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



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
