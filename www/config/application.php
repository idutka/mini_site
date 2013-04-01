<?php
require_once 'config.ini';

//автозавантаження класів
function __autoload($class_name) {

		if(preg_match("/(.+)Controller$/isU", $class_name)){

			$filename = strtolower(str_replace("Controller", "_controller", $class_name)) . '.php';
        	$file = 'controllers/' . $filename;

		}elseif (preg_match("/(.+)Model$/isU", $class_name)) {

			$filename = strtolower(str_replace("Model", "_model", $class_name)) . '.php';
       	 	$file = 'models/' . $filename;

		}else {

			$filename = $class_name . '.php';
        	$file = $filename;
		}

		// echo '<p>'.$file.'</p>';

        if (file_exists($file) == false) {
                return false;
        }

        include_once ($file);
}

//створює сторінку, позамовчуванню - сторінка з усіма постами
function createPage($class = 'GuestbookController')
{
	$page = new $class;
	$page->initPage();
	$page->viewPage();
}

//парсить url і визначає яку сторінку буде створено
if(isset($_GET['route'])){

	$r = explode("/",$_GET['route']);
	$classname = ucwords($r[0]).'Controller';

	if(class_exists($classname)){
		createPage($classname);

	}else{
		createPage();
	}

}else{
	createPage();
};
