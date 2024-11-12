<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/DashboardModel.php';
class DashboardController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new DashboardModel($db);
    }

    public function index()
    {
        $summary = $this->model->getSummary();
        require_once '../App/Views/Dashboard/dashboard.php';
    }

    public function getSummary()
    {
        echo json_encode($this->model->getSummary());
    }
}