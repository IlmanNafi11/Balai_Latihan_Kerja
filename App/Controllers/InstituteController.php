<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/InstituteModel.php';
class InstituteController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new InstituteModel($db);
    }

    public function index()
    {
        require_once "../App/Views/Institute/institute.php";
    }

    public function viewUpdateInstitute()
    {
        require_once "../App/Views/Institute/updateInstitute.php";
    }

    public function getInstituteId()
    {
        echo json_encode($this->model->getInstituteId());
    }
}