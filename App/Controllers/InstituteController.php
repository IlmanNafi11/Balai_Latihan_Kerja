<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/InstituteModel.php';
class InstituteController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new InstituteModel($db);
    }

    public function index()
    {
        $institutes = $this->model->getAllInstitute();
        require_once "../App/Views/Institute/institute.php";
    }

    public function viewUpdateInstitute()
    {
        require_once "../App/Views/Institute/updateInstitute.php";
    }

    public function getInstituteId()
    {
        echo json_encode($this->model->getInstituteId());
    }

    public function getAllInstitute()
    {
        echo json_encode($this->model->getAllInstitute());
    }

    public function getInstituteById($id)
    {
        echo json_encode($this->model->getInstituteById($id));
    }

    public function updateInstitute($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $institute = [
            'id' => $id,
            'nama' => $data['nama'],
            'pimpinan' => $data['pimpinan'],
            'no_vin' => $data['no_vin'],
            'no_sotk' => $data['no_sotk'],
            'thn_berdiri' => $data['thn_berdiri'],
            'tipe' => $data['tipe'],
            'kepemilikan' => $data['kepemilikan'],
            'no_tlp' => $data['no_tlp'],
            'no_fax' => $data['no_fax'],
            'email' => $data['email'],
            'website' => $data['website'],
            'deskripsi' => $data['deskripsi']
        ];
        if (!empty($institute))
        {
            $result = $this->model->updateInstitute($institute);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data kosong']);
        }
    }
}