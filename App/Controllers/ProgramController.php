<?php
require_once '../App/Models/ProgramModel.php';

class ProgramController
{
    private $model;
    private $db;

    private $updateResult = true;
    private $insertResult = true;
    private $deleteResult = true;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->model = new ProgramModel($this->db);
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

    public function getProgramsByIdForUpdate($id)
    {
        require_once '../App/Models/RequirementsModel.php';
        $programs = $this->model->getProgramByIdForUpdate($id);
        if ($programs['success'] && !$programs['isEmpty']) {
            $requirementsModel = new RequirementsModel($this->db);
            $requirements = $requirementsModel->getRequirementsByProgram($id);
            if ($requirements['success'] && !$requirements['isEmpty']) {
                $programs['requirements'] = $requirements['requirements'];
                echo json_encode($programs);
            } else {
                http_response_code(404);
                echo $requirements;
            }
        } else {
            http_response_code(404);
            echo $programs;
        }
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

    public function updatePrograms($id)
    {
        require_once '../App/Controllers/RequirementsController.php';
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data)) {
            echo json_encode(['success' => false, 'message' => 'Data Kosong']);
            return;
        }

        $programs = [
            'id' => $id,
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
        ];

        if (!empty($programs)) {
            try {
                $programResult = $this->model->updatePrograms($programs);
                if ($programResult['success']) {
                    if (!empty($data['requirements'])) {
                        $requirementsController = new RequirementsController();
                        $result = $requirementsController->updateRequirements($data['requirements']);
                        if (!$result['success']) {
                            return $this->updateResult = false;
                        }
                    }

                    if (!empty($data['new_requirements'])) {
                        $requirementsController = new RequirementsController();
                        $result = $requirementsController->addNewRequirements($data['new_requirements'], $id);
                        if (!$result['success']) {
                            return $this->insertResult = false;
                        }
                    }

                    if (!empty($data['delete_requirements'])) {
                        $requirementsController = new RequirementsController();
                        $result = $requirementsController->deleteRequirements($data['delete_requirements']);
                        if (!$result['success']) {
                            return $this->deleteResult = false;
                        }
                    }
                    if ($this->updateResult && $this->insertResult && $this->deleteResult) {
                        echo json_encode($programResult);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => $programResult['message']]);
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Kosong']);
        }
    }

    public function deletePrograms($id)
    {
        echo json_encode($this->model->deletePrograms($id));
    }

    public function getFavoritePrograms()
    {
        echo json_encode($this->model->getFavoritePrograms());
    }
}