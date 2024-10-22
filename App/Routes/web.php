<?php
$uri = trim($_SERVER['REQUEST_URI'], '/');
if ($uri == '/' || $uri == '')
{
    require_once '../App/Controllers/LoginController.php';
    $controller = new LoginController();
    $controller->index();
} else if ($uri == '/register')
{

}