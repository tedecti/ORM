<?php
error_reporting(0);

use App\Controllers\PostController;

require_once '../vendor/autoload.php';

$postsClass = new PostController();
$posts = $postsClass->index();
$title = $_POST['title'];
$description = $_POST['description'];

if (strlen($title) > 0 && strlen($description) > 0) {
    if ($_COOKIE) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $temp_name = $_FILES["image"]["tmp_name"];
            $original_name = $_FILES["image"]["name"];
            $destination = "images/" . $original_name;
            if (move_uploaded_file($temp_name, $destination)) {
                echo "Пост успешно загружен на сервер.";
            } else {
                echo "Произошла ошибка при загрузке поста.";
            }
            $postsClass->create($title, $_COOKIE['id'], $description, $destination);
        }
    } else {
        echo 'Для начала войдите в аккаунт';
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
    <form method="POST" enctype="multipart/form-data">
        <input placeholder="Название поста..." type="text" name="title"><br>
        <textarea placeholder="Описание поста..." name="description"></textarea><br>
        <input type="file" name="image" accept="image/png, image/jpeg" id="image"><br>
        <button type="submit" name="submit">Опубликовать</button>
    </form><br>
    <?php
    foreach ($posts as $post) {
        echo $post['title'] . "<br>" . $post['description'] . "<br> <img src='" . $post['image'] . "'><br>";
    }
    ?>
</body>

</html>