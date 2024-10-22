<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';
class LoginController
{
    private $loginModel;
    function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->loginModel = new LoginAuthModel($db);
    }

    public function index()
    {
        require_once '../App/Views/Auth/login.php';
    }
}