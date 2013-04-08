<?php
/**
 * Router
 *
 * Клас для маршрутизації запитів користувача
 *
 * @author Vanya Dutka
 */
class Router {

    private $controller;
    private $action;
    private $value;

    /**
     * Constructor
     *
     * Ініціалізує клас і задає значення по замовчуванню
     *
     * @return void
     */
    function __construct() {
        $this->controller = 'Guestbook' . 'Controller';
        $this->action = 'index' . 'Action';
        $this->value = '';
    }

    
    /**
     * RUN
     *
     * Прарсить адресний рядок
     * Створює потрібний клас і запускає відповідний метод
     *
     * @return void
     */
    public function run() {

        if (isset($_GET['route'])) {

            $r = explode("/", trim($_GET['route'], "/"));

            $classname = ucwords($r[0]) . 'Controller';
            if (class_exists($classname)) {
                $this->controller = $classname;

                if (!empty($r[1])) {
                    $this->action = $r[1] . 'Action';

                    if (!empty($r[2])) {
                        $this->value = $r[2];
                    };
                };
            };
        };
        
        session_start();

        $c = $this->controller;
        $page = new $c;

        $a = $this->action;
        $page->$a($this->value);

        $page->viewPage();
    }

}