<?php

use Config\Database;

require_once '../../Config/Database.php';
require_once '../Models/DepartmentModel.php';

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
    require_once '../../Views/Departments/departments.php';
}

public function getAllDepartments()
{
    try {
    $department = $this->departmentModel->getAllDepartment();
        if (!empty($department))
        {
            echo json_encode($department);
        } else
        {
            echo json_encode(array('message' => 'Data Kosong'));
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
}

$dpr = new DepartmentsController();
$dpr -> index();