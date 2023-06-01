<?php

use Src\Controllers\User;

require_once '../vendor/autoload.php';

if ($_POST) {
    $getUser = new User();
    // $users = $user->getAllUsers();
    // var_dump($users);
    // $userById = $getUser->getUserById(2);

    // foreach ($userById as $user) {
    //     echo "$user <br>";
    // }
    $emailLogin = $_POST['emailLogin'];
    $passwordLogin = $_POST['passwordLogin'];
    $getUser->login($emailLogin, $passwordLogin);
}

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <form method="post">
        <label for="email">Почта</label><br>
        <input type="email" name="emailLogin"><br>
        <label for="password">Пароль</label><br>
        <input type="password" name="passwordLogin"><br>
        <button type="submit">Отправить</button><br>
    </form>
</body>

</html>