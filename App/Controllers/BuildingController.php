<?php
require_once '../App/Config/Database.php';
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
        $building = $this->getAllBuilding();
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
        return $this->model->getAllBuilding();
    }

    public function getBuildingById($id)
    {
        $data = $this->model->getBuildingById($id);
        if (!empty($data)) {
            echo json_encode($data);
        }
    }

    public function creteBuilding()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }

    public function updateBuilding($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }

    public function deleteBuilding($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $buildingId = $id;
            if (empty($buildingId)) {
                $result = $this->model->deleteBuilding($buildingId);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            }

        }
    }
}