<?php

require_once '../App/Models/LandingPageModel.php';

class LandingPageController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new LandingPageModel($db);
    }

    function index()
    {
        $summary = $this->model->getSummaryStatSection();
        require_once '../App/Views/LandingPage/landingPage.php';
    }
}