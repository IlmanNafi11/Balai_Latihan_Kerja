<?php
require_once '../App/Config/Database.php';
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
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode($this->model->getAllInstructor());
        }
    }

    public function getInstructorById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode($this->model->getInstructorById($id));
        }
    }

    public function getInstructorName()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode($this->model->getInstructorName());
        }
    }

    public function createInstructors()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $no_tlp = $data['phone'];
            $email = $data['email'];
            $address = $data['address'];
            if (!empty($name) && !empty($no_tlp) && !empty($email)) {
                $result = $this->model->createInstructor($name, $no_tlp, $email,$address);
                echo json_encode($result);
            }
        }
    }

    public function updateInstructors($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $no_tlp = $data['phone'];
            $email = $data['email'];
            $address = $data['address'];
            if (!empty($name) && !empty($no_tlp) && !empty($email)) {
                $result = $this->model->updateInstructor($id, $name, $no_tlp, $email);
                json_encode($result);
            }
        }
    }

    public function deleteInstructors($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            echo json_encode($this->model->deleteInstructor($id));
        }
    }
}