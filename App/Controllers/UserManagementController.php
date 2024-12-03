<?php
require_once '../App/Models/UserModel.php';

class UserManagementController
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
        require_once '../App/Views/UserManagements/userManagement.php';
    }

    public function viewAddAdmin()
    {
        require_once '../App/Views/UserManagements/addAdmin.php';
    }


    public function getUserById($id)
    {
        echo json_encode($this->model->getUsersById($id));
    }

    public function cekEmail()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        echo json_encode($this->model->cekEmail($email));
    }

    public function createUsers()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['password'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pas_foto = $_FILES['pas_foto'];
        $role = $_POST['role'] ?? 'admin';

        if (empty($name) || empty($email) || empty($phone) || empty($pas_foto) || empty($pass) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($alamat)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Pastikan semua data telah diisi.']);
            return;
        }

        $password = password_hash($pass, PASSWORD_DEFAULT);

        $validate = $this->model->cekEmail($email);
        if (!$validate['isEmpty']) {
            echo json_encode($validate);
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
                    "role" => $role,
                    "foto_path" => $filePath
                ];
                echo json_encode($this->model->createUsers($users));
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $pas_foto['error']]);
        }
    }

    public function updateUsers($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $phone = $data['phone'];
        $address = $data['address'];
        if (empty($name) || empty($phone) || empty($address)) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Data Tidak Lengkap'];
        } else {
            echo json_encode($this->model->updateUsers($id, $name, $phone, $address));
        }
    }

    public function deleteUsers($id)
    {
        echo json_encode($this->model->deleteUsers($id));
    }

    public function getAdminUsers()
    {
        echo json_encode($this->model->getUsersByRole("'super admin', 'admin'"));
    }

    public function getPenggunaUsers()
    {
        echo json_encode($this->model->getUsersByRole("'pengguna'"));
    }

    public function searchAdminUsers()
    {
        $name = $_GET['search'] ?? '';
        echo json_encode($this->model->searchUsersByRole($name, "'super admin', 'admin'"));
    }

    public function searchPenggunaUsers()
    {
        $name = $_GET['search'] ?? '';
        echo json_encode($this->model->searchUsersByRole($name, "'pengguna'"));
    }
}