<?php
require_once '../App/Models/BuildingModel.php';
class BuildingController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new BuildingModel($db);
    }

    public function index()
    {
        $buildings = $this->model->getAllBuilding();
        require_once '../App/Views/Building/building.php';
    }

    public function viewAddBuilding()
    {
        require_once '../App/Views/Building/addBuilding.php';
    }

    public function viewUpdateBuilding()
    {
        require_once '../App/Views/Building/updateBuilding.php';
    }

    public function getAllBuilding()
    {
        echo json_encode($this->model->getAllBuilding());
    }

    public function getBuildingById($id)
    {
        echo json_encode($this->model->getBuildingById($id));
    }

    public function getBuildingName()
    {
        echo json_encode($this->model->getBuildingName());
    }


    public function creteBuilding()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $namaGedung = $data['name'];
        $deskripsiGedung = $data['description'];

        if (!empty($namaGedung) && !empty($deskripsiGedung)) {
            $result = $this->model->createBuilding($namaGedung, $deskripsiGedung);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
        }
    }

    public function updateBuilding($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $idGedung = $id;
        $namaGedung = $data['name'];
        $deskripsiGedung = $data['description'];
        if (!empty($namaGedung) && !empty($deskripsiGedung)) {
            $result = $this->model->updateBuilding($idGedung, $namaGedung, $deskripsiGedung);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
        }
    }

    public function deleteBuilding($id)
    {
        echo json_encode($this->model->deleteBuilding($id));
    }
}