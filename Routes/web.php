<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if($uri == '/Department'){
    require_once '../App/Controller/DepartmentsController.php';
    $departments = new DepartmentsController();
    $departments->index();
}