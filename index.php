<?php
include_once "router.php";
$router = new Router();

// $router->addRoute('GET', '/', function () {
//     include 'pages/cart.php';
//     exit;
// });
$router->addRoute('GET', '/', function () {
    include 'pages/register.php';
    exit;
});
// ---------------------------------------------------/
$router->addRoute('POST', '/api/register', function () {
    include 'api/register.php';
    exit;
});
$router->matchRoute()
?>