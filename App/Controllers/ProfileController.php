<?php

class ProfileController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

    }

    public function index()
    {
        require_once "../App/Views/Profiles/profile.php";
    }
}