<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/DepartmentModel.php';

class DepartmentsController
{
    private $departmentModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->departmentModel = new DepartmentModel($db);
    }

    public function index()
    {
        $department = $this->departmentModel->getAllDepartment();
        require_once '../App/Views/Departments/departments.php';
    }

    public function getAllDepartments()
    {
        try {
            $department = $this->departmentModel->getAllDepartment();
            if (!empty($department)) {
                echo json_encode($department);
            } else {
                echo json_encode(array('message' => 'Data Kosong'));
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}