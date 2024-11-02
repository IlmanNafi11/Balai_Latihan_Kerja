<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/ProgramModel.php';

class ProgramController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new ProgramModel($db);
    }

    public function index()
    {
        $programs = $this->model->getAllProgram();
        require_once '../App/Views/Programs/programs.php';
    }

    public function viewAddProgram()
    {
        require_once '../App/Views/Programs/addPrograms.php';
    }

    public function viewUpdateProgram()
    {
        require_once '../App/Views/Programs/updatePrograms.php';
    }

    public function getAllPrograms()
    {
        return json_encode($this->model->getAllProgram());
    }

    public function getProgramById($id)
    {
        echo json_encode($this->model->getProgramById($id));
    }

}