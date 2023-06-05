<?php

namespace App\Controllers;

use App\Models;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class UserController extends Models
{
    public $table = 'users';
    public $token = '';

    public function getAllUsers()
    {
        return $this->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->getUserById($id);
    }

    public function getToken($email)
    {
        $sql = "SELECT token FROM {$this->table} WHERE email = '$email'"; 
        $result = $this->db->query($sql);
        $array = $result->fetch_assoc();
        $token = $array['token'];
        return $token;
    }

    public function register()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT);
        $token = $this->token;
        $token = $this->setToken();
        $sql = "INSERT INTO {$this->table} (firstname, lastname, phone, email, password, token) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password', '$token')";
        $result = $this->db->query($sql);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->db->query($sql);
        $user = $result->fetch_assoc();
        if($user!=null && password_verify($password, $user['password'])){
            setcookie('id', $user['id']);
            setcookie('email', $user['email']);
        }
    }

    public function setToken()
    {
        $this->token = null;
        $this->token = rand(100000, 999999);
        $unique = false;

        while (!$unique) {
            $this->token = null;
            $this->token = rand(100000, 999999);
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE token = '$this->token'";
            $result = $this->db->query($sql);
            $count = $result->fetch_assoc()['COUNT(*)'];

            if ($count == 0) {
                $unique = true;
            };
        }
        return $this->token;
    }
    public function sendToken($email)
    {
        $token = $this->getToken($email);
        $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
            ->setUsername('test_crocos@mail.ru')
            ->setPassword('aZ2G0TxRUgzppvrfEWip');
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message('noreply'))
            ->setFrom(['test_crocos@mail.ru' => 'noreply'])
            ->setTo(["$email" => 'user']);
        $html = "<p>$token</p>";
        $message->setBody($html, 'text/html');
        $result = $mailer->send($message);
        if ($result) {
            $token = $this->setToken();
            echo '';
        } else {
            echo 'Возникла ошибка при отправке письма.';
        }
    }

    public function resetPassword($token, $newPassword)
    {
        $new_token = $this->setToken();
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE {$this->table} SET `password` = '$newPassword', `token` = $new_token WHERE `token` = $token";
        $result = $this->db->query($sql);
    }
}
