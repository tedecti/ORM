<?php
error_reporting(0);

require_once '../vendor/autoload.php';

use App\Controllers\UserController;

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $getUser = new UserController();
    $getUser->login($email, $password);
    $getUser->sendToken($email);

    // $getUser->resetPassword(782259, '12456'); 
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <form method="post">
        <label for="email">Почта</label><br>
        <input type="email" name="email"><br>
        <label for="password">Пароль</label><br>
        <input type="password" name="password"><br>
        <button type="submit">Отправить</button><br>
    </form>
</body>

</html>