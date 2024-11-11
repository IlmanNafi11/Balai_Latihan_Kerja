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
        require_once "../App/Views/Auth/OTPAuth.php";
    }

    public function viewResetPassword()
    {
        require_once "../App/Views/Auth/resetPassword.php";
    }

    public function sendOtp()
    {
        require_once "../App/Services/OtpSender.php";
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        $validate = $this->model->validateEmailUser($email);
        if ($validate['success'] && $validate['isEmpty']) {
            echo json_encode($validate);
        } else {
            $user_id = $validate['users']['id'];
            $user_email = $validate['users']['email'];
            $kode_otp = generateOtp();
            $service = new ServiceToken();
            $payload = [
                'email' => $user_email,
                'step' => 2,
                'exp' => time() + 300
            ];
            $token = $this->service->createToken($payload);
            $expiresAt = date("Y-m-d H:i:s", strtotime("+1 hour"));
            $insertOtp = $this->model->insertOtp($user_id, $user_email,$kode_otp, $token, 2, $expiresAt);

            if ($insertOtp) {
                setcookie('userId', $user_id, time() + 3600, '/', '', true, true);
                setcookie('jwt', $token, time() + 3600, '/', '', true, true);
                $otpSender = new OtpSender();
                $result = $otpSender->sendOtp($user_email, $kode_otp);
                $result['redirect_url'] = "/password-reset/verify/{$token}";
                echo json_encode($result);
            }
        }

    }

    public function verifyOtp()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_COOKIE['jwt'])) {
            $jwtToken = $_COOKIE['jwt'];
        } else {
            echo json_encode(['success' => false, 'message' => 'Token tidak ditemukan di cookies']);
            return;
        }
        try {
          $decodeToken = validateToken($jwtToken);
          if ($decodeToken['success']) {
              $payload = $decodeToken['payload'];
              $userEmail = $payload->email;
              $usersOtp = $this->model->getOtp($userEmail);
              if ($usersOtp['success'] && $usersOtp['isEmpty']) {
                  echo json_encode($usersOtp);
              } else {
                  $expired_at = strtotime($usersOtp['users']['expires_at']);
                  $current_time = time();
                  if ($expired_at > $current_time) {
                      $inputOtp = $data['otp'];
                      if ($inputOtp == $usersOtp['users']['otp_code']) {
                          unset($_COOKIE['jwt']);
                          $payloadJwt = [
                              'email' => $userEmail,
                              'step' => 3,
                              'exp' => time() + 300
                          ];
                          $token = $this->service->createToken($payloadJwt);
                          setcookie('jwt', $token, time() + 3600, '/', '', true, true);
                          echo json_encode(['success' => true, 'message' => 'Kode OTP Valid', 'redirect_url' => '/password-reset/new']);
                      } else {
                          echo json_encode(['success' => false, 'message' => 'Kode OTP tidak valid!']);
                      }
                  } else {
                      echo json_encode(['success' => false, 'message' => 'OTP Kadaluarsa']);
                  }
              }
          } else {
              echo json_encode($decodeToken);
          }

        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function resetPassword()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['password'])){
            var_dump($data['password']);
            echo json_encode(['success' => false, 'message' => 'Input tidak boleh kosong!']);
            return;
        }

        if (isset($_COOKIE['jwt'])) {
            $jwtToken = $_COOKIE['jwt'];
        } else {
            echo json_encode(['success' => false, 'message' => 'Token tidak ditemukan di cookies']);
            return;
        }

        $decodeToken = validateToken($jwtToken);
        if ($decodeToken['success']) {
            $payload = $decodeToken['payload'];
            $userEmail = $payload->email;
            $result = $this->model->updatePassword($data['password'], $userEmail);
            echo json_encode($result);
        } else {
            echo json_encode($decodeToken);
        }
    }
}