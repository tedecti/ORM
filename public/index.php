<?php

require_once 'vendor\autoload.php';

use Src\Controllers\User;

if ($_POST) {
    $getUser = new User();
    // $users = $user->getAllUsers();
    // var_dump($users);
    $userById = $getUser->getUserById(2);

    foreach ($userById as $user) {
        echo "$user <br>";
    }
    $getUser->register();
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
    <form method="post">
        <label for="firstname">Имя</label><br>
        <input type="text" name="firstname"><br>
        <label for="lastname">Фамилия</label><br>
        <input type="text" name="lastname"><br>
        <label for="phone">Номер телефона</label><br>
        <input type="number" name="phone"><br>
        <label for="email">Почта</label><br>
        <input type="email" name="email"><br>
        <label for="password">Пароль</label><br>
        <input type="password" name="password"><br>
        <button type="submit">Отправить</button><br><br>
    </form>
</body>

</html>
</html>