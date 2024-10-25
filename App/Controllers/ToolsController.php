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
        $tools = $this->model->getAllTools();
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
        $data = $this->model->getToolsById($id);
        if (!empty($data))
        {
            echo json_encode($data);
        }
    }

    public function createTools()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $type = $data['type'];
            $description = $data['description'];

            if (!empty($name) && !empty($description))
            {
                $result = $this->model->createTools($name, $description, $type);
                echo json_encode($result);
            } else
            {
                echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
            }
        }
    }

    public function updateTools($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = json_decode(file_get_contents("php://input"), true);
            $name = $data['name'];
            $description = $data['description'];
            $type = $data['type'];
            if (!empty($name) && !empty($description))
            {
                $result = $this->model->updateTools($id, $name, $description, $type);
                echo json_encode($result);
            } else
            {
                echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
            }
        }
    }

    public function deleteTools($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $result = $this->model->deleteTools($id);
            echo json_encode($result);
        }
    }
}