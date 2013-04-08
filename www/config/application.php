<?php

require_once 'config.ini';

//автозавантаження класів
function __autoload($class_name) {

    if (preg_match("/(.+)Controller$/isU", $class_name)) {

        $filename = strtolower(str_replace("Controller", "_controller", $class_name)) . '.php';
        $file = 'controllers/' . $filename;
    } elseif (preg_match("/(.+)Model$/isU", $class_name)) {

        $filename = strtolower(str_replace("Model", "_model", $class_name)) . '.php';
        $file = 'models/' . $filename;
    } else {

        $filename = $class_name . '.php';
        $file = $filename;
    }

    // echo '<p>'.$file.'</p>';

    if (file_exists($file) == false) {
        return false;
    }

    include_once ($file);
}

$router = new Router;
$router->run();
