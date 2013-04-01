<?php
/**
 * Guestbook Controller
 *
 * Контроллер для роботи з повідомленнями
 *
 * @author Vanya Dutka
 */
class GuestbookController extends Controller{

	/**
     * Constructor
     *
     * Ініціалізує клас і створює обєкти моделі і вигляду
     * Парсить адресний рядок
     *
     * @return void
     */
	function __construct()
	{
		$this->view = new View;
		$this->model = new GuestbookModel;

		if(isset($_GET['route']))$this->parseRoute($_GET['route']);
	}

	/**
     * parsePost
     *
     * Парсить та перевіряє на валідність дані передані $_POST запитом
     *
     * @param  array $p	дані передані $_POST запитом
     * @return array
     */
	public function parsePost($p)
	{
		$message = array();
			if(isset($p['id'])){$message['id'] = $p['id']*1;};
			$message['name'] = $this->valid($p['title']);
			$message['description'] = $this->valid($p['description']);
			$message['text'] = $this->valid($p['text']);

		return $message;
	}

	/**
     * initPage
     *
     * Викликає метод для створення потрібної сторінки
     *
     * @return void
     */
	public function initPage()
	{	
		
		if ($this->route['action'] && method_exists($this,$f = $this->route['action'].'Action')) {

			$this->$f();

		}else{

			$this->view->set('warning','Сторінку не знайдено!!!');
			$this->createMainPage();
		}
	
	}

	/**
     * viewAction
     *
     * Створює сторінку перегляду одного повідомлення
     *
     * @return void
     */
	public function viewAction()
	{
		$message = $this->model->getMessage($this->route['id']);

		$this->view->set('message',$message);
		$this->view->set('title',$message['name']);
		$this->view->set('pagetype','view');
		
	}

	/**
     * deleteAction
     *
     * Створює сторінку для видалення повідомлення
     *
     * @return void
     */
	public function deleteAction()
	{
		$this->model->delMessage($this->route['id']);
		$this->view->set('warning','Повідомлення видалено!!!');
		$this->createMainPage();
		
	}

	/**
     * editAction
     *
     * Створює сторінку для редагування повідомлення
     *
     * @return void
     */
	public function editAction()
	{
				
		$message = $this->model->getMessage($this->route['id']);

		$this->view->set('message',$message);
		$this->view->set('title','Змінити повідомлення!!!');
		$this->view->set('pagetype','edit');
	}

	/**
     * addAction
     *
     * Створює сторінку для додавання повідомлення
     *
     * @return void
     */
	public function addAction()
	{
		$this->view->set('title','Додати нове повідомлення!!!');
		$this->view->set('pagetype','add');
	}

	/**
     * listAction
     *
     * Створює сторінку для для перегляду всіх повідомленнь
     * змінює або додає повідомлення якщо це було зроблено користувачем
     *
     * @return void
     */
	public function listAction()
	{
		if(isset($_POST['addmessage'])){
			$message = $this->parsePost($_POST);
			
			if($this->model->addMessage($message)){
				$this->view->set('warning','Повідомлення додано!!!');
			};
		}

		if(isset($_POST['editmessage'])){
			$message = $this->parsePost($_POST);

			if($this->model->editMassage($message)){
				$this->view->set('warning','Зміни збережено!!!');
			};
		}

		$this->view->set('title','Список всіх постів!!!');
		$this->createMainPage();
	}

	/**
     * createMainPage
     *
     * Створює головну сторінку
     *
     * @return void
     */
	public function createMainPage()
	{
		$mess = $this->model->getAllMessages();
		$this->view->set('listmessages',$mess);
		$this->view->set('pagetype','list');
		$this->view->set('title','Головна!!!');
		
	}

}