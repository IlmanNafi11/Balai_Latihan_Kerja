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
        $instructors = $this->model->GetAllInstructor();
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
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $no_tlp = $data['phone'];
        $email = $data['email'];
        $address = $data['address'];
        if (!empty($name) && !empty($no_tlp) && !empty($email)) {
            $result = $this->model->createInstructor($name, $no_tlp, $email, $address);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Terdapat Data yang Kosong']);
        }
    }

    public function updateInstructors($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $no_tlp = $data['phone'];
        $email = $data['email'];
        $address = $data['address'];
        if (!empty($name) && !empty($no_tlp) && !empty($email) && !empty($address)) {
            $result = $this->model->updateInstructor($id, $name, $no_tlp, $email, $address);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Terdapat Data yang Kosong']);
        }
    }

    public function deleteInstructors($id)
    {
        echo json_encode($this->model->deleteInstructor($id));
    }
}