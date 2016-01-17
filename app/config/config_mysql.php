<?php

return [
    'dsn'             => "mysql:host=blu-ray.student.bth.se;dbname=maem14;",
    'username'        => "maem14",
    'password'        => "97x20g\A",
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => 'phpmvc_project_',
    'verbose' 		  => false,
    //'debug_connect' => 'true',
];
