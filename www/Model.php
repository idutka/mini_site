<?php

/**
 * Main Model
 *
 * Головна модель для роботи з базою даних
 * Є батьківським для всіх інших моделей
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
    function connectDB() {
        $db = mysql_connect(SERVER, USER, PASS) or die('Немає з\'єднання з БД!!!');
        mysql_select_db(DTBASE, $db) or die('Не підключена БД!!!');
        mysql_query("SET NAMES utf8");
    }

    /**
     * valid
     *
     * Валідує потрібний текст
     *
     * @param  string  $t текст
     * @return string
     */
    public function valid($t) {
        return htmlspecialchars(addslashes(trim($t)));
    }

}

// class Model