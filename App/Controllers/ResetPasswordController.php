<?php
require_once '../App/Models/UserModel.php';

class ResetPasswordController
{
    private $model;
    private $service;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new UserModel($db);
        $this->service = new ServiceToken();
    }

    public function index()
    {
        require_once "../App/Views/Auth/emailVerifications.php";
    }

    public function viewOtp()
    {
        $token = $_SESSION['token'] ?? null;
        if ($token === null) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $step = $auth->step;
        if ($step == '2') {
            require_once "../App/Views/Auth/OTPAuth.php";
        } else {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }
    }

    public function viewResetPassword()
    {
        $token = $_SESSION['token'] ?? null;
        if ($token === null) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $step = $auth->step;
        if ($step == '3') {
            require_once "../App/Views/Auth/resetPassword.php";
        } else {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }
    }

    public function resetStep()
    {
        $token = $_SESSION['token'] ?? null;
        if ($token === null) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            header('Location: /password-reset/request');
            exit();
        }

        $userId = $auth->userId;
        $userEmail = $auth->email;

        unset($_SESSION['token']);
        $payloadJwt = [
            'userId' => $userId,
            'email' => $userEmail,
            'step' => 2,
            'exp' => time() + 3600
        ];
        $token = $this->service->createToken($payloadJwt);
        $_SESSION['token'] = $token;
        echo json_encode(['success' => true, 'redirect' => '/password-reset/verify', 'message' => 'Step berhasil direset']);
    }

    public function sendOtp()
    {
        require_once "../App/Services/ServiceOtp.php";
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        $validate = $this->model->validateEmailUser($email);
        if ($validate['success'] && $validate['isEmpty']) {
            echo json_encode($validate);
        } else {
            $user_id = $validate['users']['id'];
            $user_email = $validate['users']['email'];
            $kode_otp = generateOtp();
            $payload = [
                'userId' => $user_id,
                'email' => $user_email,
                'step' => 2,
                'exp' => time() + 3600
            ];
            $token = $this->service->createToken($payload);
            $expiresAt = date("Y-m-d H:i:s", strtotime("+1 hour"));
            $insertOtp = $this->model->insertOtp($user_id, $user_email, $kode_otp, $expiresAt);

            if ($insertOtp['success']) {
                $_SESSION['token'] = $token;
                $otpSender = new ServiceOtp();
                $result = $otpSender->sendOtp($user_email, $kode_otp, $token);
                echo json_encode($result);
            }
        }
    }

    public function resendOtp()
    {
        require_once "../App/Services/ServiceOtp.php";
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            echo json_encode($auth);
            return;
        }

        $userId = $auth->userId;
        $userEmail = $auth->email;
        unset($_SESSION['token']);
        $payload = [
            'userId' => $userId,
            'email' => $userEmail,
            'step' => 2,
            'exp' => time() + 3600
        ];

        $token = $this->service->createToken($payload);
        $kodeOtp = generateOtp();
        $expiresAt = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $insertOtp = $this->model->insertOtp($userId, $userEmail, $kodeOtp, $expiresAt);

        if ($insertOtp['success']) {
            $otpSender = new ServiceOtp();
            $result = $otpSender->sendOtp($userEmail, $kodeOtp, $token);
            if ($result['success']) {
                $_SESSION['token'] = $token;
                echo json_encode(['success' => true, 'message' => 'Kode OTP Berhasil dikirim Ulang!']);
            } else {
                http_response_code(500);
                echo json_encode($result);
            }
        } else {
            echo json_encode($insertOtp);
        }
    }

    public function verifyOtp()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            echo json_encode($auth);
            return;
        }

        $userId = $auth->userId;
        $userEmail = $auth->email;
        $usersOtp = $this->model->getOtp($userId);
        if ($usersOtp['success'] && $usersOtp['isEmpty']) {
            echo json_encode($usersOtp);
        } else {
            $expired_at = strtotime($usersOtp['users']['expires_at']);
            $current_time = time();
            if ($expired_at > $current_time) {
                $inputOtp = $data['otp'];
                if ($inputOtp == $usersOtp['users']['otp_code']) {
                    unset($_SESSION['token']);
                    $payloadJwt = [
                        'userId' => $userId,
                        'email' => $userEmail,
                        'step' => 3,
                        'exp' => time() + 3600
                    ];
                    $token = $this->service->createToken($payloadJwt);
                    $_SESSION['token'] = $token;
                    echo json_encode(['success' => true, 'message' => 'Kode OTP Valid', 'redirect_url' => '/password-reset/new', 'token' => $token]);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Kode OTP tidak valid!']);
                }
            } else {
                http_response_code(410);
                echo json_encode(['success' => false, 'message' => 'OTP Kadaluarsa']);
            }
        }
    }

    public function resetPassword()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input tidak boleh kosong!']);
            return;
        }

        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth) && !$auth['success']) {
            http_response_code(401);
            echo json_encode($auth);
            return;
        }

        $regexPassword = '/^[a-zA-Z0-9]{8,}$/';
        if (!preg_match($regexPassword, $data['password'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password minimum terdiri dari 8 digit']);
            return;
        }

        $userId = $auth->userId;
        $result = $this->model->updatePassword(password_hash($data['password'], PASSWORD_DEFAULT), $userId);
        session_unset();
        session_destroy();
        echo json_encode($result);
    }
}