<?php
require_once '../vendor/autoload.php';

$routes = [
    '/ORM/public/' => 'index',
    '/ORM/public/register' => 'register',
    '/ORM/public/login' => 'login'
];

$requestUri = $_SERVER['REQUEST_URI'];

$requestUri = strtok($requestUri, '?');
if (array_key_exists($requestUri, $routes)) {
    $controller = $routes[$requestUri];
    
    require_once($controller . '.php');
} else {
    echo 'Error 404: Page not found';
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

</body>

</html>