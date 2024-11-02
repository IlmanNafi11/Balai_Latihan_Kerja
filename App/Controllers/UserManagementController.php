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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pas_foto = $_FILES['pas_foto'];

        if (empty($name) || empty($email) || empty($phone) || empty($pas_foto)) {
            echo json_encode(['success' => false, 'message' => 'Pastikan semua data telah diisi.']);
            return;
        }

        if ($pas_foto['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/profiles/';
            $fileName = uniqid() . '-' . basename($pas_foto['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($pas_foto['tmp_name'], $filePath)) {
                $users = [
                    "name" => $name,
                    "email" => $email,
                    "password" => $password,
                    "phone" => $phone,
                    "tanggal_lahir" => $tanggal_lahir,
                    "jenis_kelamin" => $jenis_kelamin,
                    "alamat" => $alamat,
                    "role" => 'admin',
                    "foto_path" => $filePath
                ];
                echo json_encode($this->model->createUsers($users));
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $pas_foto['error']]);
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
        if (empty($name) && empty($phone) && empty($address) && empty($tanggal_lahir) && empty($password)) {
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