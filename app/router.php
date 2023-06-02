<?php
$routes = [
    '/' => 'home',
    '/register' => 'register',
    '/login' => 'login'
];

$requestUri = $_SERVER['REQUEST_URI'];

$requestUri = strtok($requestUri, '?');

if (array_key_exists($requestUri, $routes)) {
    $controller = $routes[$requestUri];

    require_once($controller . '.php');
    
    $controllerObj = new $controller();
    
    $controllerObj->index();
} else {
    echo 'Error 404: Page not found';
}
?>
