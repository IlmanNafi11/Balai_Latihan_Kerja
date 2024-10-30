<?php
function loadController($controller, $method, $params = []) {
    require_once "../App/Controllers/{$controller}.php";
    $controllerInstance = new $controller();
    if (!is_array($params)) {
        $params = [$params];
    }
    call_user_func_array([$controllerInstance, $method], $params);
}