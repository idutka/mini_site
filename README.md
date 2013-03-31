mini_site
=========
проект згідно MVC
стурктура
www
    controllers 
        guestbook_controller.php
    models
        guestbook_model.php
    views
        guestbook
            form.tpl
            view.tpl
            list.tpl
        layout
            main.tpl
    config
    Controller.php
    Model.php
    View.php
    index.php

всі php файли, крім index і тих що будуть міститися у директорії config - повинні бути класами
клас guestbook_controller.php є дочірнім по відношенню до Controller.php - обробляються дії користувача додавання/редарування/видалення/перегляд запису/перегляд списку 
так само і моделі guestbook_model.php є дочірнім по відношенню до Model.php - відбувається обробка даних, валідація 
View.php - керує роботою темплейтів, які знаходяться у директорії views
    layout/main.tpl - головний темплейт (обгортка)
    guestbook/ - темплейти відповідних сторінок
у config - містяться всі налаштування, зокрема підключення до БД
Назви класів формуються так GuestbookController, GuestbookModel
Проект має мати наступні переходи по сторінках 
    /guestbook/list - список постів;
    /guestbook/add - додати новий пост;
    /guestbook/edit/id - редагувати, де id - ідентифікатор запису;
    /guestbook/delete - видалити пост;
    /guestbook/view/id - переглянути пост, де id - ідентифікатор поста;
Прямий лінк на проект, наприклад http://bla.if.ua/ повинен вести на список постів у гостьовій
Тобто потрібно розробити своєрідний парсер адреси сторінки
