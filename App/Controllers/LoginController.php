<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';

class LoginController
{
    private $loginModel;

    function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->loginModel = new LoginAuthModel($db);
    }

    public function index()
    {
        require_once '../App/Views/Auth/login.php';
    }

    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $email = $input['email'];
        $password = $input['password'];

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Email atau password tidak boleh kosong']);
            return;
        }

        $user = $this->loginModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'redirect_url' => '/dashboard']);
        } else {
            // Login gagal
            echo json_encode(['status' => 'error', 'message' => 'Email atau password salah']);
        }
    }
}