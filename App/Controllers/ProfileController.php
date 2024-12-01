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
        $profile ="/".$users['users']['profile_picture'];
        require_once "../App/Views/Profiles/profile.php";
    }

    public function getUsersById($id)
    {
        echo json_encode($this->model->getUsersById($id));
    }

    public function getImageById($id)
    {
        echo json_encode($this->model->getImageById($id));
    }

    public function updateProfile($id)
    {
        $name = $_POST['name'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $address = $_POST['address'] ?? null;
        $pas_foto = $_FILES['profile_picture'] ?? null;

        if (empty($name) || empty($phone) || empty($address)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap!']);
            return;
        }

        if ($pas_foto && $pas_foto['error'] === UPLOAD_ERR_OK) {
            $fileExtension = strtolower(pathinfo($pas_foto['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpeg', 'jpg', 'png'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo json_encode(['success' => false, 'message' => 'Format foto tidak didukung!']);
                return;
            }


            $uploadDirectory = 'Uploads/profiles/';
            $fileName = uniqid() . '-' . basename($pas_foto['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($pas_foto['tmp_name'], $filePath)) {
                $_SESSION['name'] = $name;
                $_SESSION['userID'] = $id;
                $_SESSION["path_profile"] = $filePath;
                echo json_encode($this->model->updateUsers($id, $name, $phone, $address, $filePath));
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal memindahkan foto profil']);
            }
        } else {
            echo json_encode($this->model->updateUsers($id, $name, $phone, $address, null));
        }
    }
}