<?php
require_once 'config.ini';

/**
 * Main Model
 *
 * Клас для роботи з базою даних
 *
 * @author Vanya Dutka
 */
class Model {

	/**
     * connectDB
     *
     * Створює зєднання з базою даних
     *
     * @return void
     */
	function connectDB()
	{
		$db = mysql_connect(SERVER,USER,PASS) or die('Немає з\'єднання з БД!!!');
		mysql_select_db(DTBASE,$db) or die('Не підключена БД!!!');
		mysql_query("SET NAMES utf8");
	}

	/**
     * getMessage
     *
     * Повертає повідомлення
     *
     * @param  int	id повідомлення
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
     * @param  array повідомлення
     * @return boolean
     */
	public function addMessage($m)
	{
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
     * @param  array повідомлення
     * @return boolean
     */
	public function editMassage($m)
	{	
		mysql_query("UPDATE `message` SET `name` = '".$m['name']."',`description` = '".$m['description']."',`text` = '".$m['text']."',`date_modified` = NOW() WHERE id = ".$m['id'].";");
		return true;
	}

	/**
     * delMessage
     *
     * Видаляє повідомлення
     *
     * @param  int id повідомлення
     * @return boolean
     */
	public function delMessage($id)
	{
		mysql_query('DELETE FROM `message` WHERE `id` = '.$id.';');
		return true;
	}

} // class Model