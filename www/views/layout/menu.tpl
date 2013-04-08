<div id="menu">
    <a href="/guestbook/list" <?php echo ($pt=='list')?'class="active"':'';?> >
        Всі повідомлення
    </a>
    <?php if(!empty($_SESSION['id_group'])){ ?>
    <a href="/guestbook/add" <?php echo ($pt=='add')?'class="active"':'';?> >
        Додати повідомлення
    </a>
    <?php } ?>
<div id="userpanel">
    <?php if(empty($_SESSION['name'])){ ?>
        <a href="/user/login">Вхід</a>
        <a href="/user/register">Реєстрація</a>
    <?php }else{ ?>
        <span><?php echo $_SESSION['name']; ?></span>
        <a href="/user/exit">Вихід</a>
    <?php } ?>
</div>
</div>

