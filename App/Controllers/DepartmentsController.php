<?php
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

    public function viewAddDepartment()
    {
        require_once '../App/Views/Departments/addDepartments.php';
    }

    public function viewUpdateDepartment()
    {
        require_once '../App/Views/Departments/updateDepartments.php';
    }

    public function getAllDepartments()
    {
        echo json_encode($this->departmentModel->getAllDepartment());
    }

    public function getDepartmentById($id)
    {
        echo json_encode($this->departmentModel->getDepartmentById($id));
    }

    public function getDepartmentName()
    {
        echo json_encode($this->departmentModel->getDepartmentName());
    }

    public function createDepartment()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];
        $instituteID = $data['instituteID'];

        if (!empty($name) && !empty($description) && !empty($instituteID)) {
            $result = $this->departmentModel->createDepartment($name, $description, $instituteID);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
        }
    }

    public function updateDepartment($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];
        if (!empty($name) && !empty($description)) {
            $result = $this->departmentModel->updateDepartment($id, $name, $description);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
        }
    }

    public function deleteDepartment($id)
    {
        echo json_encode($this->departmentModel->deleteDepartment($id));
    }

    public function getMostProgramsInDepartment()
    {
        echo json_encode($this->departmentModel->getMostProgramsInDepartment());
    }
}