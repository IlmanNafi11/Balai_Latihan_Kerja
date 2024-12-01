<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/ToolsModel.php';

class ToolsController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new ToolsModel($db);
    }

    public function index()
    {
        require_once '../App/Views/ToolsManagement/tool.php';
    }

    public function viewAddTools()
    {
        require_once '../App/Views/ToolsManagement/addTool.php';
    }

    public function viewUpdateTools()
    {
        require_once '../App/Views/ToolsManagement/updateTool.php';
    }

    public function getAllTools()
    {
        echo json_encode($this->model->getAllTools());
    }

    public function getToolsByID($id)
    {
        echo json_encode($this->model->getToolsById($id));
    }

    public function getToolsName()
    {
        echo json_encode($this->model->getToolsName());
    }

    public function getToolsByProgram($id)
    {
        return $this->model->getToolsByPrograms($id);
    }

    public function insertProgramTools($tools, $programId)
    {
        foreach ($tools as $tool) {
            $result = $this->model->insertProgramsTools($tool, $programId);
            if (!$result) {
                return false;
            }
        }
        return true;
    }

    public function createTools()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $type = $data['type'];
        $description = $data['description'];
        if (!empty($name) && !empty($description)) {
            $result = $this->model->createTools($name, $description, $type);
            echo json_encode($result);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
        }
    }

    public function updateTools($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];
        $type = $data['type'];
        if (!empty($name) && !empty($description)) {
            $result = $this->model->updateTools($id, $name, $description, $type);
            echo json_encode($result);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
        }
    }

    public function deleteTools($id)
    {
        echo json_encode($this->model->deleteTools($id));
    }

    public function deleteProgramTools($data, $programId)
    {
        foreach ($data as $id) {
            $result = $this->model->deleteProgramsTools($id, $programId);
            if (!$result) {
                return false;
            }
        }
        return true;
    }

    public function searchTools()
    {
        $name = $_GET['search'] ?? '';

        $tools = $this->model->searchTools($name);
        echo json_encode($tools);
    }
}