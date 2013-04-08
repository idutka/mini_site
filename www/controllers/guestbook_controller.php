<?php

/**
 * Guestbook Controller
 *
 * Контроллер для роботи з повідомленнями
 *
 * @author Vanya Dutka
 */
class GuestbookController extends Controller {

    /**
     * Constructor
     *
     * Ініціалізує клас і створює обєкти моделі і вигляду
     *
     * @return void
     */
    function __construct() {
        $this->view = new View;
        $this->model = new GuestbookModel;
    }

    /**
     * indexAction
     *
     * Створює сторінку по замовчуванню
     *
     * @return void
     */
    public function indexAction() {
        $this->createMainPage();
        $this->view->set('warning', 'Сторінка не знайдена!!');
    }

    /**
     * listAction
     *
     * Створює сторінку для для перегляду всіх повідомленнь
     * змінює або додає повідомлення якщо це було зроблено користувачем
     *
     * @return void
     */
    public function listAction() {

        if (isset($_POST['addmessage'])) {

            if ($this->model->addMessage($_POST)) {
                $this->view->set('warning', 'Повідомлення додано!!!');
            };
        }

        if (isset($_POST['editmessage'])) {

            if ($this->model->editMassage($_POST)) {
                $this->view->set('warning', 'Зміни збережено!!!');
            };
        }

        $this->createMainPage();
        $this->view->set('title', 'Список всіх постів!!!');
    }

    /**
     * viewAction
     *
     * Створює сторінку перегляду одного повідомлення
     *
     * @return void
     */
    public function viewAction($id) {
        $message = $this->model->getMessage($id);

        $this->view->setContent(
                $this->view->render('message', $message)
        );
        $this->view->set('title', $message['name']);
    }

    /**
     * deleteAction
     *
     * Створює сторінку для видалення повідомлення
     *
     * @return void
     */
    public function deleteAction($id) {
        $this->model->delMessage($id);
        $this->view->set('warning', 'Повідомлення видалено!!!');
        $this->createMainPage();
    }

    /**
     * editAction
     *
     * Створює сторінку для редагування повідомлення
     *
     * @return void
     */
    public function editAction($id) {

        $message = $this->model->getMessage($id);

        $this->view->setContent(
                $this->view->render('form', $message)
        );

        $this->view->set('title', 'Змінити повідомлення!!!');
    }

    /**
     * addAction
     *
     * Створює сторінку для додавання повідомлення
     *
     * @return void
     */
    public function addAction() {
        $this->view->set('title', 'Додати нове повідомлення!!!');
        $this->view->setContent(
                $this->view->render('form', false)
        );
        $this->view->set('pagetype', 'add');
    }

    /**
     * createMainPage
     *
     * Створює головну сторінку
     *
     * @return void
     */
    public function createMainPage() {
        $mess = $this->model->getAllMessages();

        $this->view->setContent(
                $this->view->render('listmessages', $mess)
        );
        $this->view->set('pagetype', 'list');
        $this->view->set('title', 'Головна!!!');
    }

}