<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';

class ProgramController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

    }

    public function index()
    {
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
}