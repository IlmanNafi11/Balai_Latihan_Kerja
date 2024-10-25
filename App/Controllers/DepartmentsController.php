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

    public function getDepartmentById($id)
    {
        return $this->departmentModel->getDepartmentById($id);
    }

    public function createDepartment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $description = $data['description'];
            $instituteID = $data['instituteID'];

            if (!empty($name) && !empty($description) && !empty($instituteID))
            {
                $result = $this->departmentModel->createDepartment($name, $description, $instituteID);
                echo json_encode($result);
            } else
            {
                echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            }
        }
    }

    public function updateDepartment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $description = $data['description'];
            if (!empty($name) && !empty($description) && !empty($instituteID))
            {
                $result = $this->departmentModel->updateDepartment($id, $name, $description);
                echo json_encode($result);
            } else
            {
                echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            }
        }
    }

    public function deleteDepartment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $result = $this->departmentModel->deleteDepartment($id);
            echo json_encode($result);
        }
    }
}