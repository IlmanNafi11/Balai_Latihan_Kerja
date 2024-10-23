<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';

class UserManajementController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

    }

    public function index()
    {
        require_once '../App/Views/UserManagements/userManagement.php';
    }
}