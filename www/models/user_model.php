<?php

/**
 * Guestbook Model
 *
 * Модель для роботи з даними користувача
 *
 * @author Vanya Dutka
 */
class UserModel extends Model {

    /**
     * Constructor
     *
     * Підєднюється до бази даних
     *
     * @return void
     */
    function __construct() {
        $this->connectDB();
    }

    /**
     * signinUser
     *
     * Залогінює користувача
     *
     * @param  array $u	дані про користувача передані $_POST запитом
     * @return boolean
     */
    public function signinUser($u) {

        $result = mysql_query("select id,id_group,pass,first_name from users where email = '" . $this->valid($u['email']) . "';");
        $myrow = mysql_fetch_array($result);
        if ($myrow) {
            if ($myrow['pass'] == md5($u['password'])) {

                mysql_query("UPDATE `users` SET `date_last` = NOW() WHERE id = " . $myrow['id'] . ";");

                $_SESSION['name'] = $myrow['first_name'];
                $_SESSION['id'] = $myrow['id'];
                $_SESSION['id_group'] = $myrow['id_group'];

                return TRUE;
            } else {
                return 'не правильний пароль';
            };
        } else {
            return 'не знайдено користувача з таким email';
        };


        return FALSE;
    }

    /**
     * signupUser
     *
     * Реєструє нового користувача
     *
     * @param  array $u	дані про користувача передані $_POST запитом
     * @return boolean|string
     */
    public function signupUser($u) {

        $user = $this->validUserData($u);

        if (empty($user['error']) && !empty($user['first_name']) && !empty($user['last_name']) && !empty($user['email']) && !empty($user['password'])) {
            $sql = "INSERT INTO `users` (`id`, `id_group`, `first_name`, `last_name`, `email`, `pass`, `date_reg`, `date_last`) 
                                    VALUES (NULL, '1', '" . $user["first_name"] . "', '" . $user["last_name"] . "', '" . $user["email"] . "', '" . $user["password"] . "', NOW(), NOW());";
            $result = mysql_query($sql);
            if ($result) {

                $this->sendData($user);

                return TRUE;
            } else {
                return $result;
            }
        }
        return $user['error'];
    }

        /**
     * validUserData
     *
     * Перевіряє на валідність дані про користувача
     *
     * @param  array $u	дані про користувача передані $_POST запитом
     * @return array
     */
    private function validUserData($u) {

        $user['error'] = '';

        if (strlen($u['first_name']) > 2) {
            $user['first_name'] = $this->valid($u['first_name']);
        } else {
            $user['error'] .= 'вкажіть імя не менше 3 символів' . "\n";
        };

        if (strlen($u['last_name']) > 2) {
            $user['last_name'] = $this->valid($u['last_name']);
        } else {
            $user['error'] .= 'вкажіть прізвище не менше 3 символів' . "\n";
        };

        if (preg_match("/^.+@.+\..+$/i", $u['email'])) {
            if ($this->findEmail($u['email']) == 0) {
                $user['email'] = $this->valid($u['email']);
            } else {
                $user['error'] .= 'такий email уже зареєстрований' . "\n";
            }
        } else {
            $user['error'] .= 'email вказано не вірно' . "\n";
        }

        if (strlen($u['password']) > 5) {
            if ($u['password'] === $u['password2']) {
                $user['password'] = md5($u['password']);
            } else {
                $user['error'] .= 'паролі не співпадають' . "\n";
            }
        } else {
            $user['error'] .= 'пароль повинен мати не менше 6 символів' . "\n";
        };

        return $user;
    }

        /**
     * reminderPass
     *
     * Змінює пароль користувача користувача
     *
     * @param  array $e	email користувача 
     * @return boolean
     */
    public function reminderPass($e) {

        if ($this->findEmail($e['email']) != 0) {

            $pass = $this->generatePassword();

            $header = "Content-type: text/plain; charset=\'utf-8\'";
            $subject = "Відновлення пароля для входу bvb.look.if.ua";
            $message = "Ваш новий пароль: " . $pass;

            if (mail($e['email'], $subject, $message, $header)) {

                mysql_query("UPDATE `users` SET `pass` = '" . md5($pass) . "' WHERE  `email` ='" . $e['email'] . "';");
                return TRUE;
            };
        }

        return FALSE;
    }

        /**
     * generatePassword
     *
     * Генерує новий пароль
     *
     * @param  integer $length	довжина потрібного пароля
     * @return string
     */
    private function generatePassword($length = 6) {
        
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

      /**
     * findEmail
     *
     * Перевіряє чи зареєстрований уже email
     *
     * @param  string $e email для перевірки
     * @return integer
     */
    private function findEmail($e) {

        $result = mysql_query("select id from users where email = '$e'");
        return mysql_num_rows($result);
    }

        /**
     * exitUser
     *
     * Розалогінює користувача
     * Знищує сесію
     *
     * @return void
     */
    public function exitUser() {

        unset($_SESSION['name']);
        unset($_SESSION['id']);
        unset($_SESSION['id_group']);

        session_destroy();
    }

        /**
     * sendData
     *
     * Відправляє лист на email, щойно зареєстрованому користувачу
     *
     * @param  array $u	дані про користувача
     * @return void
     */
    private function sendData($u) {

        $header = "Content-type: text/plain; charset=\'utf-8\'";
        $subject = "Реєстрація на сайті bvb.look.if.ua";
        $message = "Ви зареєструвались на сайті bvb.look.if.ua .";

        if (mail($u['email'], $subject, $message, $header)) {
//            echo "все гуд";
        } else {
//            echo "нот гуд";
        }
    }

}