<?php

/**
 * Main View
 *
 * Клас для виведення контенту
 *
 * @author Vanya Dutka
 */
class View {

    /**
     * массив змінних
     * у яких зберігаються дані для виводу
     * 
     * @var array
     */
    private $vars;

    /**
     * змінних у якій зберігається головний контент сторінки
     * 
     * @var string
     */
    private $content;

    /**
     * set
     *
     * задає або присвоює нове значення у $vars[]
     *
     * @param  string $key назва змінної
     * @param  array|int|string|... $var значення змінної
     *
     * @return boolean
     */
    public function set($key, $var) {
        $this->vars[$key] = $var;

        return true;
    }

    /**
     * get
     *
     * повертає значення із $vars[]
     *
     * @param  string $key назва змінної
     *
     * @return array|int|string|...
     */
    public function get($key) {
        if (!isset($this->vars[$key])) {
            return null;
        }
        return $this->vars[$key];
    }

    /**
     * setContent
     *
     * задає контент сторінки
     *
     * @param  string $c контент сторнінки
     *
     * @return void
     */
    public function setContent($c) {
        $this->content = $c;
    }

    /**
     * render
     *
     * генерує контент
     *
     * @param  string $view назва методу який буде згенеровано
     * @param  string $param параметри які потрібно передати в метод
     *
     * @return string
     */
    public function render($view, $param = '') {
        ob_start();

        $this->$view($param);

        return ob_get_clean();
    }

    /**
     * viewLayout
     *
     * Виводить сторінку
     *
     * @return void
     */
    public function viewLayout() {
        include TPL . 'layout/main.tpl';
    }

    /**
     * viewMenu
     *
     * Показує меню
     *
     * @return void
     */
    public function viewMenu() {
        $pt = $this->get('pagetype');
        include TPL . 'layout/menu.tpl';
    }

    /**
     * message
     *
     * Виводить ціле повідомлення
     *
     * @param  array $m повідомлення
     * @return void
     */
    public function message($m) {
        include TPL . 'guestbook/view.tpl';
    }

    /**
     * listmessages
     *
     * Виводить всі повідомлення
     *
     * @param  array $listmessages всі повідомлення
     * @return void
     */
    public function listmessages($listmessages) {
        include TPL . 'guestbook/list.tpl';
    }

    /**
     * form
     *
     * Виводить форму для додавання або редагування повідомлення
     *
     * @param  array|boolean $m повідомлення
     * @return void
     */
    public function form($m = false) {
        include TPL . 'guestbook/form.tpl';
    }

    /**
     * replaceDate
     *
     * Змінює формат дати
     *
     * @param  string  дата і час
     * @return string
     */
    public function replaceDate($d) {
        return date("d.m.Y в H:i", strtotime($d));
    }

    /**
     * loginpanel
     *
     * Виводить форму для залогінення
     *
     * @return void
     */
    public function loginpanel() {
        include TPL . 'user/login.tpl';
    }
    
    /**
     * regpanel
     *
     * Виводить форму реєстрації
     *
     * @return void
     */
    public function regpanel() {
        include TPL . 'user/register.tpl';
    }
    
    /**
     * reminder
     *
     * Виводить форму для відновлення пароля
     *
     * @return void
     */
    public function reminder() {
        include TPL . 'user/reminder.tpl';
    }

}// class View