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
        foreach ($requirements as $requirement) {
            $idRequirements = $requirement['id'];
            $requirementDesc = $requirement['requirement'];

            $result = $this->model->updateRequirements($idRequirements, $requirementDesc);
            if (!$result) {
                return false;
            }
        }
        return true;
    }

    public function addNewRequirements($requirements = [], $id)
    {
        $insertResult = ['success' => true];
        foreach ($requirements as $requirement) {
            $result = $this->model->createRequirements($id, $requirement);
            if (!$result['success']) {
                $insertResult['success'] = false;
                break;
            }
        }
        return $insertResult;
    }

    public function deleteRequirements($requirements = [])
    {
        $deleteResult = ['success' => true];
        foreach ($requirements as $requirement) {
            $result = $this->model->deleteRequirements($requirement);
            if (!$result['success']) {
                $deleteResult['success'] = false;
                break;
            }
        }
        return $deleteResult;
    }

    public function getRequirementsProgram($id)
    {
        return $this->model->getRequirementsByProgram($id);
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