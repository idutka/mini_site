<?php

/**
 * Guestbook Controller
 *
 * Контроллер для роботи з повідомленнями
 *
 * @author Vanya Dutka
 */
class UserController extends Controller {

    /**
     * Constructor
     *
     * Ініціалізує клас і створює обєкти моделі і вигляду
     * Парсить адресний рядок
     *
     * @return void
     */
    function __construct() {
        $this->view = new View;
        $this->model = new UserModel;
    }

    /**
     * viewAction
     *
     * Створює сторінку перегляду одного повідомлення
     *
     * @return void
     */
    public function indexAction() {
        $this->view->setContent(
                $this->view->render('loginpanel')
        );
        $this->view->set('title', 'Вхід!!!');
    }

    /**
     * deleteAction
     *
     * Створює сторінку для видалення повідомлення
     *
     * @return void
     */
    public function loginAction() {

        if (isset($_POST['signin'])) {
            $signin = $this->model->signinUser($_POST);

            if ($signin === TRUE) {
                $this->view->set('warning', 'вітаю ' . $_SESSION['name']);
                $this->view->set('title', 'Гостьова книга');
            } else {
                $this->view->set('warning', $signin);
                $this->indexAction();
            };
        } else {
            $this->indexAction();
        }
    }

    /**
     * editAction
     *
     * Створює сторінку для редагування повідомлення
     *
     * @return void
     */
    public function registerAction() {

        if (isset($_POST['signup'])) {
            $signup = $this->model->signupUser($_POST);

            if ($signup === TRUE) {
                $this->view->set('warning', 'реєстрація пройшла успішно');
                $this->indexAction();
            } else {
                $this->view->set('warning', $signup);

                $this->showRegPanel();
            };
        } else {
            $this->showRegPanel();
        };
    }

    public function showRegPanel() {

        $this->view->setContent(
                $this->view->render('regpanel')
        );
        $this->view->set('title', 'Реєстрація!!!');
    }

    /**
     * editAction
     *
     * Створює сторінку для редагування повідомлення
     *
     * @return void
     */
    public function exitAction() {

        $this->model->exitUser();

        $this->indexAction();

        $this->view->set('warning', 'Ви вийшли із системи');
        $this->view->set('title', 'Вихід!!!');
    }

    /**
     * editAction
     *
     * Створює сторінку для редагування повідомлення
     *
     * @return void
     */
    public function reminderAction() {

        if (isset($_POST['reminder'])) {
            
            $signup = $this->model->reminderPass($_POST);

            if ($signup === TRUE) {
                $this->view->set('warning','новий пароль відправлено на вказаний email');
            } else {
                $this->view->set('warning', 'вказаний email не вірний');

                $this->view->setContent(
                    $this->view->render('reminder')
                );
            };
        } else {
            $this->view->setContent(
                    $this->view->render('reminder')
            );
        }


        $this->view->set('title', 'Відновлення пароля!!!');
    }

}