<?php
function loadController($controller, $method) {
    require_once "../App/Controllers/{$controller}.php";
    $controllerInstance = new $controller();
    $controllerInstance->$method();
}