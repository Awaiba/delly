<?php

if (!function_exists("throwError")) {

    function throwError($title = '???', $description = 'Unknown error occurred') {
        $error = [
            'title' => $title,
            'description' => $description
        ];

        $path = dirname(__DIR__) . '/staff/view/error.php';

        if (!file_exists($path)) {
            die("ERROR FILE NOT FOUND: " . $path);
        }

        include $path;
        die;
    }

}
