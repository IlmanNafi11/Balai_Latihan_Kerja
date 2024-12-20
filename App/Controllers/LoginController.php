<?php
require_once '../App/Models/LoginAuthModel.php';

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

    public function loginAdmin()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $email = $input['email'];
        $password = $input['password'];

        if (empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email atau password tidak boleh kosong']);
            return;
        }

        $user = $this->loginModel->loginAdmin($email, $password);

        if (isset($user['status']) && !$user['status']) {
            echo json_encode($user);
        } else {
            $userID = $user['id'];
            $userEmail = $user['email'];
            $userRole = $user['role'];
            $username = $user['nama'];

            $issuedAt = time();
            $expired = $issuedAt + 86400;

            $payload = [
                'iat' => $issuedAt,
                'exp' => $expired,
                "users" => [
                    'id' => $userID,
                    'email' => $userEmail,
                    'role' => $userRole,
                    'username' => $username
                ]
            ];

            $token = $this->jwtService->createToken($payload);
            if ($token) {
                $_SESSION['userID'] = $userID;
                $_SESSION['name'] = $username;
                $_SESSION['role'] = $userRole;
                $_SESSION['token'] = $token;
                $_SESSION['path_profile'] = "/". $user['profile_picture'];
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'redirect_url' => '/dashboard', 'token' => $token]);
            }
        }
    }

    public function loginUsers()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $email = $input['email'];
        $password = $input['password'];

        if (empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email atau password tidak boleh kosong']);
            return;
        }

        $user = $this->loginModel->loginUsers($email, $password);

        if (isset($user['status']) && !$user['status']) {
            echo json_encode($user);
        } else {
            $userID = $user['id'];
            $userEmail = $user['email'];
            $userRole = $user['role'];
            $username = $user['nama'];

            $issuedAt = time();
            $expired = $issuedAt + 86400;

            $payload = [
                'iat' => $issuedAt,
                'exp' => $expired,
                "users" => [
                    'id' => $userID,
                    'email' => $userEmail,
                    'role' => $userRole,
                    'username' => $username
                ]
            ];

            $token = $this->jwtService->createToken($payload);
            if ($token) {
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'token' => $token]);
            }
        }
    }
}