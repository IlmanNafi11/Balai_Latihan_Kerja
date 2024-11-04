<?php
require_once '../App/Models/UserModel.php';

class ProfileController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new UserModel($db);

    }

    public function index()
    {
        $id = $_SESSION['userID'];
        $users = $this->model->getUsersById($id);
        $profile = "/Public/" . htmlspecialchars($users['users']['profile_picture']);
        require_once "../App/Views/Profiles/profile.php";
    }

    public function getUsersById($id)
    {
        echo json_encode($this->model->getUsersById($id));
    }

    public function updateProfile($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $no_tlp = $data['phone'];;
        $address = $data['address'];
        if (!empty($name) && !empty($no_tlp) && !empty($address)) {
            echo json_encode($this->model->updateAdmin($id, $name, $no_tlp, $address));
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
        }

    }
}