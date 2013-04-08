<?php
/**
 * Guestbook Model
 *
 * Модель для роботи з повідомленнями
 *
 * @author Vanya Dutka
 */
class GuestbookModel extends Model{

	/**
     * Constructor
     *
     * Підєднюється до бази даних
     *
     * @return void
     */
	function __construct()
	{
		$this->connectDB();
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
     * getMessage
     *
     * Повертає повідомлення
     *
     * @param  int $id id повідомлення
     * @return array
     */
	public function getMessage($id)
	{
		$result = mysql_query('SELECT `id`,`name`,`description`,`text`,`date_create`,`date_modified` 
								FROM `message` WHERE `id`='.$id.';');
		$myrow  = mysql_fetch_array($result);
		$message = array(	
							'id'			=> $myrow['id'],
							'name'			=> $myrow['name'],
							'description' 	=> $myrow['description'],
							'text'		 	=> $myrow['text'],
							'date_create'	=> $myrow['date_create'],
							'date_modified'	=> $myrow['date_modified']
						);
		return $message;
	}

	/**
     * getAllMessages
     *
     * Повертає всі повідомлення
     *
     * @return array
     */
	public function getAllMessages()
	{
		$result = mysql_query('SELECT `id`,`name`,`description`,`text`,`date_create`,`date_modified` 
								FROM `message`;');
		
		$messages = array();
		while ($myrow  = mysql_fetch_array($result)){
			$messages[] = array(
								'id'			=> $myrow['id'],
								'name'			=> $myrow['name'],
								'description' 	=> $myrow['description'],
								'text'		 	=> $myrow['text'],
								'date_create'	=> $myrow['date_create'],
								'date_modified'	=> $myrow['date_modified']
								);
		}
		return $messages;
	}

	/**
     * addMessage
     *
     * Додає в базу даних нове повідомлення
     *
     * @param  array $m повідомлення
     * @return boolean
     */
	public function addMessage($post)
	{
		$m = $this->parsePost($post);
		$sql = "INSERT INTO `message` (`id`,`name`,`description`,`text`,`date_create`,`date_modified`) 
				VALUES (NULL, '".$m['name']."', '".$m['description']."', '".$m['text']."', NOW(), NOW());";
		mysql_query($sql);	
		return true;
	}

	/**
     * editMassage
     *
     * Зміннює повідомлення
     *
     * @param  array $m повідомлення
     * @return boolean
     */
	public function editMassage($post)
	{	
		$m = $this->parsePost($post);
		mysql_query("UPDATE `message` SET `name` = '".$m['name']."',`description` = '".$m['description']."',`text` = '".$m['text']."',`date_modified` = NOW() WHERE id = ".$m['id'].";");
		return true;
	}

	/**
     * delMessage
     *
     * Видаляє повідомлення
     *
     * @param  int $id id повідомлення
     * @return boolean
     */
	public function delMessage($id)
	{
		mysql_query('DELETE FROM `message` WHERE `id` = '.$id.';');
		return true;
	}
}