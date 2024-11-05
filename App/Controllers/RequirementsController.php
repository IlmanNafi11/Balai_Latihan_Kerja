<?php
require_once '../App/Models/RequirementsModel.php';

class RequirementsController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new RequirementsModel($db);
    }

    public function getRequirementsByProgram($id)
    {
        echo json_encode($this->model->getRequirementsByProgram($id));
    }

    public function createRequirements($programId, $requirements = [])
    {
        $result = [];
        foreach ($requirements as $requirement) {
            $result = $this->model->createRequirements($programId, $requirement);
        }
        return $result;
    }
}