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

    public function updateRequirements($requirements = [])
    {
        $updateResult = ['success' => false];
        foreach ($requirements as $requirement) {
            try {
                $idRequirements = $requirement['id'];
                $requirementDesc = $requirement['requirement'];
                $updateResult = $this->model->updateRequirements($idRequirements, $requirementDesc);
            } catch (PDOException $e) {
                error_log($e->getMessage());
            }

        }
        return $updateResult;
    }

    public function addNewRequirements($requirements = [], $id)
    {
        $insertResult = ['success' => false];
        foreach ($requirements as $requirement) {
            $insertResult = $this->model->createRequirements($id, $requirement);
        }
        return $insertResult;
    }

    public function deleteRequirements($requirements = [])
    {
        $deleteResult = ['success' => false];
        foreach ($requirements as $requirement) {
            $deleteResult = $this->model->deleteRequirements($requirement);
        }
        return $deleteResult;
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