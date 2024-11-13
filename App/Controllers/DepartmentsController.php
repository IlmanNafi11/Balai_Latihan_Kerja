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
        $name = $_POST['name'];
        $description = $_POST['description'];
        $instituteID = $_POST['instituteId'];
        $image = $_FILES['image'];

        if (empty($name) && empty($description) && empty($instituteID) && empty($image)) {
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/departments/';
            $fileName = uniqid() . '-' . basename($image['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                echo json_encode($this->departmentModel->createDepartment($name, $description, $instituteID, $filePath));
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $image['error']]);
        }


    }

    public function updateDepartment($id)
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image'] ?? null;

        if (empty($name) && empty($description) && empty($instituteID) && empty($image)) {
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        $imagePath = null;
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/departments/';
            $fileName = uniqid() . '-' . basename($image['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                $imagePath = $filePath;
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
                return;
            }
        }
        echo json_encode($this->departmentModel->updateDepartment($id, $name, $description, $imagePath));
    }

    public function deleteDepartment($id)
    {
        echo json_encode($this->departmentModel->deleteDepartment($id));
    }

    public function getMostProgramsInDepartment()
    {
        echo json_encode($this->departmentModel->getMostProgramsInDepartment());
    }

    public function searchDepartments()
    {
        $name = $_GET['search'] ?? '';

        $departments = $this->departmentModel->searchDepartment($name);
        echo json_encode($departments);
    }

}