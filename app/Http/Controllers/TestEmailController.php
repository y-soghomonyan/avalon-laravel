<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestEmailController extends Controller
{
    //


 public $mi_conn;
    public function mysql_conn() {
        $mi_conn = mysqli_connect('localhost', 'root', '', 'avalon') or die("MySQL connect error");
        mysqli_query($mi_conn, "SET NAMES 'utf8'");
        $this->mi_conn = $mi_conn;
        return $mi_conn;
    }

    public function check_mailbox($username) {
        // Проверяем на наличие в базе

        $result = mysqli_query($this->mi_conn, "SELECT * FROM mailbox WHERE `username`='{$username}'");
        $mass = mysqli_fetch_array($result);

        if (!empty($mass) && $mass['username']) {
            return "Почтовый ящик уже существует.";
        }

        // Проверяем на правильность формата (учетная запись должна быть в виде email)
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return "Адрес {$username} указан не верно.";
        }
    }

    public function check_password($password) {
        // Проверка сложности на количество символов
         $password_min_length= 8;
        $length = mb_strlen($password, 'UTF-8');
        if ($length < $password_min_length) {
            return "Пароль должен быть более {$password_min_length} символов.";
        }
        // Проверка сложности на наличие цифр и букв
        preg_match('/\d/', $password, $d_matches);
        preg_match('/\w/', $password, $w_matches);
        if (!$d_matches[0] || !$w_matches[0]) {
            return "Пароль должен содержать буквы и цифры.";
        }
    }

    public function create_mailbox($username, $password) {
        // Проверка учетной записи на наличие в базе и правильность формата
        $result_check_mailbox = $this->check_mailbox($username);
        if ($result_check_mailbox) {
            return "Ошибка при создании учетной записи. {$result_check_mailbox}";
        }

        // Проверка пароля на сложность
        $result_check_password = $this->check_password($password);
//        dd($result_check_password);
        if ($result_check_password) {
            return "Ошибка при создании учетной записи. {$result_check_password}";
        }

        // Создаем почтовую учетную запись

        $username_arr = explode("@", $username);
        $user = $username_arr[0];
        $domain = $username_arr[1];
        $username_3char = str_replace('.', '_', implode('/', str_split(mb_substr($user, 0, 3))));
        $username_createdate = date("Y.m.d.H.i.s");
        $createdate = date("Y-m-d H:i:s");
        $password_hash = exec("doveadm pw -s 'ssha512' -p '{$password}'");
        $username_path = "{$domain}/{$username_3char}/{$user}-{$username_createdate}/";
        if (mysqli_query($this->mi_conn, "INSERT INTO mailbox (`username`, `password`, `language`, `maildir`, `domain`, `created`) VALUES ('{$username}', '{$password_hash}', 'ru_RU', '{$username_path}', '{$domain}', '{$createdate}')")) {
            return "Учетная запись создана";
        } else {
            return "Ошибка sql-запроса";
        }
    }


    function my_curl_uni($url, $postfields) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }



    public function getemails()
    {
        $url = "http://api.dmosk.ru";
        $postfields = array('username'=>'test@dmosk.ru', 'password'=>'test123test');
        $result = $this->my_curl_uni($url, $postfields);
        print_r($result);
 }

    public function index(){
//        $username = 'test@dmosk.ru';
//        $password = 'test_test123';
//
//        $mi_conn = $this->mysql_conn();
//        $result = $this->create_mailbox($username, $password);
//
//        echo $result;

//        $this->getemails();

//            $mailbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'example@gmail.com', 'password');
//
//    // This gives an array of message IDs for all messages that are UNSEEN
//            $unseenMessages = imap_search($mailbox, 'UNSEEN');
//
//    // Keep in mind that imap_search returns false, if it doesn't find anything
//            $unseenCount = !$unseenMessages ? 0 : count($unseenMessages);
//            echo "$unseenCount New Emails!\n";
//
//            if ($unseenMessages) {
//                // The second parameter of imap_setflag_full function is a comma separated string of message IDs
//                // It can also be a range eg 1:5, which would be the same as 1,2,3,4,5
//                imap_setflag_full($mailbox, implode(',', $unseenMessages), '\Seen');
//            }
    }







}
