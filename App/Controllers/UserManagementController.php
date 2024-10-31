<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/UserManagementModel.php';

class UserManagementController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new UserManagementModel($db);
    }

    public function index()
    {
        $users = $this->model->getAllUsers();
        require_once '../App/Views/UserManagements/userManagement.php';
    }

    public function viewAddAdmin()
    {
        require_once '../App/Views/UserManagements/addAdmin.php';
    }

    public function getAllUsers()
    {
        echo json_encode($this->model->getAllUsers());
    }

    public function getUserById($id)
    {
        echo json_encode($this->model->getUserById($id));
    }

    public function createUsers()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $users = [
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => $data['password'],
            "phone" => $data['phone'],
            "tanggal_lahir" => $data['tanggal_lahir'],
            "jenis_kelamin" => $data['jenis_kelamin'],
            "alamat" => $data['alamat'],
            "role" => $data['role']
        ];
        if (empty($data)){
            return ['success' => false, 'message' => 'Data Kosong'];
        } else {
            echo json_encode($this->model->createUsers());
        }
    }

    public function updateUsers($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $phone = $data['phone'];
        $address = $data['address'];
        if (empty($name) && empty($phone) && empty($address)) {
            return ['success' => false, 'message' => 'Data Tidak Lengkap'];
        } else {
            echo json_encode($this->model->updateUsers($id, $name, $phone, $address));
        }
    }

    public function updateAdmin($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $phone = $data['phone'];
        $address = $data['address'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $password = $data['password'];
        if (empty($name) && empty($phone) && empty($address) && empty($tanggal_lahir) && empty($password)){
            return ['success' => false, 'message' => 'Data tidak lengkap'];
        } else {
            echo json_encode($this->model->updateAdmin($id, $name, $phone, $address, $password, $tanggal_lahir));
        }
    }

    public function deleteUsers($id)
    {
        echo json_encode($this->model->deleteUsers($id));
    }
}