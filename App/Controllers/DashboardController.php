<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';
class DashboardController
{
    private $model;
    public function __construct()
    {

    }

    public function index()
    {
        require_once '../App/Views/Dashboard/dashboard.php';
    }
}