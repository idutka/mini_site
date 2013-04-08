<?php

/**
 * Main controller
 *
 * Головний контроллер
 * Є батьківським для всіх інших контроллерів
 *
 * @author Vanya Dutka
 */
class Controller {

    /**
     * Обєкт вигляду
     * 
     * @var object
     */
    protected $view;

    /**
     * Обєкт моделі
     * 
     * @var object
     */
    protected $model;

    /**
     * viewPage
     *
     * Показує сторінку користувачу
     *
     * @return void
     */
    public function viewPage() {
        $this->view->viewLayout();
    }

    /**
     * indexAction
     *
     * Метод який викликається по замовчуванню
     *
     * @return void
     */
    public function indexAction() {
        echo 'main page';
    }

    /**
     * __call
     *
     * У разі спроби викликати неіснуючий метод
     * даний метод викликає індексний метод
     *
     * @return void
     */
    public function __call($method, $arg) {
        $this->indexAction();
    }

}

// class Controller