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
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email atau password tidak boleh kosong']);
            return;
        }

        $user = $this->loginModel->login($email, $password);

        if (isset($user['status']) && !$user['status']) {
            http_response_code(401);
            echo json_encode($user);
        } else {
            $userID = $user['id'];
            $userEmail = $user['email'];
            $userRole = $user['role'];
            $token = $this->jwtService->createToken($userID, $userEmail, $userRole);
            if ($token) {
                $_SESSION['userID'] = $userID;
                $_SESSION['token'] = $token;
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'redirect_url' => '/dashboard', 'token' => $token]);
            }
        }
    }
}