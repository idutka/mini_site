<div id="message">
	<h1><?php echo $m['name']; ?></h1>
	<p><?php echo $m['description']; ?></p>
	<p><?php echo nl2br($m['text']); ?></p>
	<p>
		<span>Створено:</span><?php echo $this->replaceDate($m['date_create']); ?>
		<span>Змінено:</span><?php echo $this->replaceDate($m['date_modified']); ?>
                <?php if(!empty($_SESSION['id_group'])){ ?>
			<span class="edit">
				<a href='/guestbook/delete/<?php echo $m['id'];?>' class="btn">del</a>
				<a href='/guestbook/edit/<?php echo $m['id'];?>' class="btn">edit</a>
			</span>
                <?php } ?>
	</p>
</div>