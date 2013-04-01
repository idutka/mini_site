<?php
/**
 * Main View
 *
 * Клас для виведення контенту
 *
 * @author Vanya Dutka
 */
class View {

	/**
	* массив змінних
	* у яких зберігаються дані для виводу
	* 
	* @var array
	*/
	private $vars;

	/**
     * set
     *
     * задає або присвоює нове значення у $vars[]
     *
     * @param  string $key назва змінної
     * @param  array|int|string|... $var значення змінної
     *
     * @return boolean
     */
	public function set($key, $var) {
        $this->vars[$key] = $var;

        return true;
	}

	/**
     * get
     *
     * повертає значення із $vars[]
     *
     * @param  string $key назва змінної
     *
     * @return array|int|string|...
     */
	public function get($key) {
	        if (!isset($this->vars[$key])) {
	                return null;
	        }
	        return $this->vars[$key];
	}

	/**
     * viewLayout
     *
     * Виводить сторінку
     *
     * @return void
     */
	public function viewLayout()
	{
		include TPL.'layout/main.tpl';
	}

	/**
     * viewMenu
     *
     * Показує меню
     *
     * @return void
     */
	public function viewMenu()
	{	
		$pt = $this->get('pagetype');
		include TPL.'layout/menu.tpl';
	}

	/**
     * viewMessage
     *
     * Виводить ціле повідомлення
     *
     * @param  array $m повідомлення
     * @return void
     */
	public function viewMessage($m)
	{	
		include TPL.'guestbook/view.tpl';
	}


	/**
     * viewListMessages
     *
     * Виводить всі повідомлення
     *
     * @param  array $listmessages всі повідомлення
     * @return void
     */
	public function viewListMessages($listmessages)
	{	
		include TPL.'guestbook/list.tpl';
	}

	/**
     * viewForm
     *
     * Виводить форму для додавання або редагування повідомлення
     *
     * @param  array|boolean $m повідомлення
     * @return void
     */
	public function viewForm($m = false)
	{	
		include TPL.'guestbook/form.tpl';
	}


	/**
     * replaceDate
     *
     * Змінює формат дати
     *
     * @param  string  дата і час
     * @return string
     */
	public function replaceDate($d) 
	{
		return preg_replace("/^(\d{4})-(\d{2})-(\d{2})\s(\d{2})\:(\d{2}).*/", "\\3.\\2.\\1 в \\4:\\5",$d);
	}


	/**
     * viewContent
     *
     * Виводить контент сторінки
     *
     * @return void
     */
	public function viewContent()
	{	


		switch ($this->get('pagetype')) {
			case 'view':
					$this->viewMessage($this->get('message'));
				break;

			case 'edit':
					$this->viewForm($this->get('message'));
				break;

			case 'add':
					$this->viewForm(false);
				break;

			case 'list':
					$this->viewListMessages($this->get('listmessages'));
				break;
			
			default:
					$this->viewListMessages($this->get('listmessages'));
				break;
		}
	}


} // class View