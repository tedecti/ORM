<?php

require_once '../vendor/autoload.php';

use App\Controllers\UserController;

$user = new UserController();

if(isset($_POST['emailButton'])) {
    if ($_POST) {
        $email = $_POST['email'];
        $user->getToken($email);
        $user->sendToken($email);
    }
}
if(isset($_POST['submit'])) {
    if ($_POST['token']) {
        $token = $_POST['token'];
        $newPassword = $_POST['newPassword'];
        $user->resetPassword($token, $newPassword);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>Введите почту, на которую придет письмо с кодом</label>
        <input type="email" name="email" id="email"><br>
        <button name="emailButton">Отправить</button><br>
        <label>Введите код из письма</label>
        <input type="number" name="token"><br>
        <label>Введите новый пароль</label>
        <input type="password" name="newPassword"><br>
        <button name="submit">Отправить</button>
    </form>
</body>

</html>