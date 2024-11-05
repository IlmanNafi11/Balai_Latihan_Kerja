<?php
require_once '../App/Models/ProgramModel.php';

class ProgramController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new ProgramModel($db);
    }

    public function index()
    {
        $programs = $this->model->getAllProgram();
        require_once '../App/Views/Programs/programs.php';
    }

    public function viewAddProgram()
    {
        require_once '../App/Views/Programs/addPrograms.php';
    }

    public function viewUpdateProgram()
    {
        require_once '../App/Views/Programs/updatePrograms.php';
    }

    public function getAllPrograms()
    {
        return json_encode($this->model->getAllProgram());
    }

    public function getProgramsById($id)
    {
        echo json_encode($this->model->getProgramsById($id));
    }

    public function getProgramsByDepartment($id)
    {
        echo json_encode($this->model->getProgramsByDepartment($id));
    }

    public function createPrograms()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data)) {
            echo json_encode(['success' => false, 'message' => 'Data Kosong']);
            return;
        }

        $programs = [
            'nama' => $data['name'],
            'status_pendaftaran' => $data['status_register'],
            'tgl_mulai_pendaftaran' => $data['start_date'],
            'tgl_akhir_pendaftaran' => $data['end_date'],
            'standar' => $data['standar'],
            'jml_peserta' => $data['participant'],
            'deskripsi' => $data['description'],
            'instructor_id' => $data['instructor_id'],
            'building_id' => $data['building_id'],
            'department_id' => $data['department_id'],
            'requirements' => $data['requirements']
        ];

        if (!empty($programs)) {
            try {
                $result = $this->model->createProgram($programs);
                echo json_encode($result);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Kosong']);
        }

    }
}