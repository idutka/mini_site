<div id="messages">
	<h1>Всі повідомлення</h1>

	<?php foreach($listmessages as $m) { ?>
		<div class="mess">
			<h2><a href='/guestbook/view/<?php echo $m['id'];?>'><?php echo $m['name'];?></a></h2>
			<p><?php echo$m['description'];?></p>
			<p>
			<span><?php echo $this->replaceDate($m['date_create']);?></span>
			<span class="edit">
				<a href='/guestbook/delete/<?php echo $m['id'];?>' class="btn">del</a>
				<a href='/guestbook/edit/<?php echo $m['id'];?>' class="btn">edit</a>
			</span>
			</p>
		</div>

	<?php } ?>

</div>