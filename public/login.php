<?php
error_reporting(0);

require_once '../vendor/autoload.php';

use App\Controllers\UserController;

$email = $_POST['email'];
$password = $_POST['password'];
if ($_POST) {
    $getUser = new UserController();
    $getUser->login($email, $password);
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
        <button type="submit">Отправить</a></button><br>
    </form>
</body>

</html>