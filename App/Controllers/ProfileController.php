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
        require_once "../App/Views/Profiles/profile.php";
    }

    public function getUsersById($id)
    {
        echo json_encode($this->model->getUsersById($id));
    }
}