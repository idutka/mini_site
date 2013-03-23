<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);

require 'application/Controller.php';

//створюєм  головний контроллер
$page = new Controller();	
	
//передаєм в головний контроллер дані з $_POST і $_GET запитів
$page->initPage($_POST,$_GET); 

//показуєм сторінку
$page->viewPage();
