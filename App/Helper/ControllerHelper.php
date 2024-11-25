<?php
function loadController($controller, $method, $params = []) {
    require_once "../App/Controllers/{$controller}.php";
    $controllerInstance = new $controller();
    if (!is_array($params)) {
        $params = [$params];
    }
    call_user_func_array([$controllerInstance, $method], $params);
}

function generateOtp()
{
    $otp = random_int(0, 999999);
    return str_pad((string) $otp, 6, '0', STR_PAD_LEFT);
}

function generateRegistrationNumber($length = 6)
{
    return str_pad(random_int(0, 999999), $length, '0', STR_PAD_LEFT);
}