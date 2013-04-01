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
	* Массив даних які містяться у URL
	* 
	* @var array
	*/
	protected $route;


	/**
     * parseRoute
     *
     * Парсить адресний рядок
     *
     * @param  string $r частина адресного радка, яка передана як route 
     * @return void
     */
	public function parseRoute($r)
	{
		$a = explode("/",$r);

		$this->route['name'] 	= isset($a[0])?$this->valid($a[0]):false;
		$this->route['action']  = isset($a[1])?$this->valid($a[1]):false;
		$this->route['id'] 	 	= isset($a[2])?($a[2]*1):false;
	}

	/**
     * valid
     *
     * Валідує потрібний текст
     *
     * @param  string  $t текст
     * @return string
     */
	public function valid($t)
	{
		return htmlspecialchars(addslashes(trim($t)));
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