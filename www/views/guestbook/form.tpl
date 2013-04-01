<div class="forma">
	<h2><?php echo $m?'Змінити повідомлення':'Додати повідомлення';?></h2>
<form action="/guestbook/list" method="post">
	<input type="hidden" name="id" value="<?php echo $m['id']?>" >
	<input name="title" placeholder="Назва"	type="text" value="<?php echo $m['name']?>" required/>
	<textarea name="description" rows="3" placeholder="Короткий текст" required><?php echo $m['description']?></textarea>
	<textarea name="text" rows="7" placeholder="Повний текст" required><?php echo $m['text']?></textarea>
	<button name="<?php echo $m?'editmessage':'addmessage';?>" class="btn">Зберегти</button>
	</form>
</div>