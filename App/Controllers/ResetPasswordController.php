<?php

class ResetPasswordController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

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
}