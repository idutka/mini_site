<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $this->get('title');?></title>
	<link type="text/css" href="/style.css" rel="STYLESHEET" />
</head>
<body>
	<div id="wrapper">

		<?php $this->viewMenu();?>
		<p id="warning"><?php echo nl2br($this->get('warning')); ?></p>
		
		<?php echo $this->content;?>

	</div>
</body>
</html>