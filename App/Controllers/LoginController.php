<?php
require_once '../App/Models/LoginAuthModel.php';
;

class LoginController
{
    private $loginModel;
    private $jwtService;

    function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->loginModel = new LoginAuthModel($db);
        $this->jwtService = new ServiceToken();
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
            $userID = $user['id'];
            $userName = $user['nama'];
            $userRole = $user['role'];
            $payload = ['userID' => $userID, 'userName' => $userName, 'role' => $userRole];
            $token = $this->jwtService->createToken($payload);
            $_SESSION['userID'] = $userID;
            $_SESSION['token'] = $token;

            echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'redirect_url' => '/dashboard', 'token' => $token]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email atau password salah']);
        }
    }
}