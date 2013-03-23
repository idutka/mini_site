<?php
/**
 * Main View
 *
 *Клас для виведення контенту
 *
 * @author Vanya Dutka
 */
class View {

	private $title = "Головна";
	private $warning = "";
	private $allmessages = "";

	/**
     * setTitle
     *
     * Задає заголовок сторінки
     *
     * @param  string  заголовок сторінки
     * @return void
     */
	public function setTitle($t)
	{
		$this->title = $t;
	}

	/**
     * setWarning
     *
     * Задає повідомлення
     *
     * @param  string повідомлення
     * @return void
     */
	public function setWarning($w)
	{
		$this->warning = $w;
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
		include 'layout.tpl';
	}

	/**
     * viewMessage
     *
     * Повертає ціле повідомлення
     *
     * @param  array повідомлення
     * @return string
     */
	public function viewMessage($m)
	{	
		return "<div id=\"message\">
					<h1>".$m['name']."</h1>
					<p>".$m['description']."</p>
					<p>".$m['text']."</p>
					<p><span>Створено:</span>".$this->replaceDate($m['date_create'])."<span>Змінено:</span>".$this->replaceDate($m['date_modified'])."</p>
				</div>";
	}

	/**
     * viewEditMessage
     *
     * Повертає форму для редагування повідомлення
     *
     * @param  array повідомлення
     * @return string
     */
	public function viewEditMessage($m)
	{
		return '<div id="editmessage" class="forma">
					<h2>Змінити повідомлення</h2>
				<form action="/bvb/" method="post">
					<input type="hidden" name="id" value="'.$m['id'].'" >
					<input name="title" placeholder="Назва"	type="text" value="'.$m['name'].'" required/>
					<textarea name="description" rows="3" placeholder="Короткий текст" required>'.$m['description'].'</textarea>
					<textarea name="text" rows="7" placeholder="Повний текст" required>'.$m['text'].'</textarea>
					<button name="editmessage">Зберегти зміни</button>
		  		</form>
				</div>';
	}

	/**
     * addMessages
     *
     * Додає в список повідомлення
     *
     * @param  array повідомлення
     * @return void
     */
	public function addMessages($m)
	{
		$this->allmessages .= 	"<tr>
									<td style='white-space: normal;'>".$m['name']."</td>
									<td style='white-space: normal;'><a href='?view=".$m['id']."' >".$m['description']."</a></td>
									<td>".$this->replaceDate($m['date_create'])."</td>
									<td>".$this->replaceDate($m['date_modified'])."</td>
									<td><a href='?edit=".$m['id']."' >edit</a></td>
									<td><a href='?del=".$m['id']."' >del</a></td>
								</tr>";
	}

	/**
     * replaceDate
     *
     * Змінює формат дати
     *
     * @param  string  дата і час
     * @return string
     */
	private function replaceDate($d) 
	{
		return preg_replace("/^(\d{4})-(\d{2})-(\d{2})\s(\d{2})\:(\d{2}).*/", "\\3.\\2.\\1 в \\4:\\5",$d);
	}


} // class View