<?php
require_once '../App/Models/InstructorModel.php';

class InstructorController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new InstructorModel($db);
    }

    public function index()
    {
        require_once '../App/Views/Instructors/instructors.php';
    }

    public function viewAddInstructor()
    {
        require_once '../App/Views/Instructors/addInstructors.php';
    }

    public function viewUpdateInstructor()
    {
        require_once '../App/Views/Instructors/updateInstructors.php';
    }

    public function getAllInstructors()
    {
        echo json_encode($this->model->getAllInstructor());
    }

    public function getInstructorById($id)
    {

        echo json_encode($this->model->getInstructorById($id));
    }

    public function getInstructorName()
    {
        echo json_encode($this->model->getInstructorName());
    }

    public function createInstructors()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $image = $_FILES['image'];

        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($image)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/instructors/';
            $fileName = uniqid() . '-' . basename($image['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                echo json_encode($this->model->createInstructor($name, $phone, $email, $address, $filePath));
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $image['error']]);
        }
    }

    public function updateInstructors($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $image = $_FILES['image'] ?? null;

        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        $imagePath = null;
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/instructors/';
            $fileName = uniqid() . '-' . basename($image['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                $imagePath = $filePath;
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
                return;
            }
        }
        echo json_encode($this->model->updateInstructor($id, $name, $phone, $email, $address, $imagePath));
    }

    public function deleteInstructors($id)
    {
        echo json_encode($this->model->deleteInstructor($id));
    }

    public function searchInstructors()
    {
        $name = $_GET['search'] ?? '';

        $instructors = $this->model->searchInstructors($name);
        echo json_encode($instructors);
    }
}