<?php
require 'View.php';
require 'Model.php';

/**
 * Main controller
 *
 *Класс який обробляє всі запити і генерує контент
 *
 * @author Vanya Dutka
 */
class Controller {

	public $view;
	public $model;

	/**
     * Constructor
     *
     * Ініціалізує клас і створює обєкти моделі і вигляду
     * Підєднюється до бази даних
     *
     * @return void
     */
	function __construct(){

		$this->view 	= new View();
		$this->model 	= new Model();

		$this->model->connectDB();

	}

	/**
     * initPage
     *
     * Створює структуру сторінки
     *
     * @param  array	дані передані $_POST запитом
     * @param  array 	дані передані $_GET запитом
     * @return void
     */
	public function initPage($post,$get)
	{	
		if (isset($get['del'])) {
			$this->model->delMessage($get['del']*1);
			$this->view->setWarning('Повідомлення видалено!!!');

		}elseif (isset($get['edit'])) {
			$this->view->setWarning(
				$this->view->viewEditMessage(
					$this->model->getMessage(
						$get['edit']*1
							)));

		}elseif (isset($get['view'])) {
			$message = $this->model->getMessage($get['view']*1);
			$this->view->setWarning(
				$this->view->viewMessage($message));
			$this->view->setTitle($message['name']);

		}elseif (isset($post['editmessage'])) {
			$message = $this->parsePost($post);

			if($this->model->editMassage($message)){
				$this->view->setWarning('Зміни збережено!!!');
			};

		}elseif (isset($post['addmessage'])) {
			$message = $this->parsePost($post);

			if($this->model->addMessage($message)){
				$this->view->setWarning('Повідомлення додано!!!');
			};
		}

		$this->createMainPage();
		
	}

	/**
     * parsePost
     *
     * Парсить та перевіряє на валідність дані передані $_POST запитом
     *
     * @param  array	дані передані $_POST запитом
     * @return array
     */
	public function parsePost($p)
	{
		$message = array();
			if(isset($p['id'])){$message['id'] = $p['id']*1;};
			$message['name'] = htmlspecialchars(addslashes(trim($p['title'])));
			$message['description'] = htmlspecialchars(addslashes(trim($p['description'])));
			$message['text'] = htmlspecialchars(addslashes(trim($p['text'])));

		return $message;
	}

	/**
     * createMainPage
     *
     * Створює головну частину сторінки
     *
     * @return void
     */
	public function createMainPage()
	{
		$mess = $this->model->getAllMessages();
		foreach ($mess as $value) {
			$this->view->addMessages($value);
		}
	}

	/**
     * viewPage
     *
     * Показує сторінку користувачу
     *
     * @return void
     */	
	public function viewPage()
	{
		$this->view->viewLayout();
	}

} // class Controller