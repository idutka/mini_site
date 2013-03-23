<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $this->title;?></title>
	<link type="text/css" href="style.css" rel="STYLESHEET" />
</head>
<body>
	<div id="wrapper">
		<div><a href="/bvb/">На головну</a></div>
		
		<?php echo $this->warning;?>

		
		<div id="messages">
			<h2>Всі повідомлення</h2>
		<table cellspacing="1" cellpadding="4" width="100%" border="0">
			<thead>
				<tr class='downheadmain'>
					<th>назва</th>
					<th>повідомлення</th>
					<th>створення</th>
					<th>змінено</th>
					<th>редагувати</th>
					<th>видалити</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $this->allmessages;?>
			</tbody>
		</table>
		</div>



		<div id="addmessage" class="forma">
			<h2>Додати повідомлення</h2>
		<form action="/bvb/" method="post">
			<input name="title" placeholder="Назва"	type="text" value="" required/>
			<textarea name="description" rows="3" placeholder="Короткий текст" required></textarea>
			<textarea name="text" rows="7" placeholder="Повний текст" required></textarea>
			<button name="addmessage">Додати повідомлення</button>
  		</form>
		</div>


	</div>
</body>
</html>