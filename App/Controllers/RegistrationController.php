<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/RegistrationsModel.php';

class RegistrationController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new RegistrationsModel($db);
    }

    public function index()
    {
        require_once "../App/Views/Registers/registrantData.php";
    }

    public function getRegistrationsSummary()
    {
        echo json_encode($this->model->getRegistrationsSummary());
    }
}