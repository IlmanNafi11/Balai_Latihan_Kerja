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
        echo json_encode($this->model->getAllProgram());
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
                echo json_encode($requirements);
            }
        } else {
            http_response_code(404);
            echo json_encode($programs);
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
        $name = $_POST['name'];
        $status_pendaftaran = $_POST['status_register'];
        $tgl_mulai_pendaftaran = $_POST['start_date'];
        $tgl_akhir_pendaftaran = $_POST['end_date'];
        $standar = $_POST['standar'];
        $jml_peserta = $_POST['participant'];
        $deskripsi = $_POST['description'];
        $instructor_id = $_POST['instructor_id'];
        $building_id = $_POST['building_id'];
        $department_id = $_POST['department_id'];
        $image = $_FILES['image'];
        $requirements = $_POST['array'];

        if (empty($name) && empty($status_pendaftaran) && empty($tgl_mulai_pendaftaran) && empty($tgl_akhir_pendaftaran) && empty($standar) && empty($jml_peserta) && empty($deskripsi) && empty($instructor_id) && empty($building_id) && empty($department_id) && empty($image) && empty($requirements)) {
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDirectory = 'Uploads/programs/';
            $fileName = uniqid() . '-' . basename($image['name']);
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                $programs = [
                    'name' => $name,
                    'status_register' => $status_pendaftaran,
                    'start_date' => $tgl_mulai_pendaftaran,
                    'end_date' => $tgl_akhir_pendaftaran,
                    'standar' => $standar,
                    'jml_peserta' => $jml_peserta,
                    'deskripsi' => $deskripsi,
                    'instructor_id' => $instructor_id,
                    'building_id' => $building_id,
                    'department_id' => $department_id,
                    'image_path' => $filePath,
                    'requirements' => $requirements,
                ];
                echo json_encode($this->model->createProgram($programs));
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $image['error']]);
        }
    }

    public function updatePrograms($id)
    {
        require_once '../App/Controllers/RequirementsController.php';

        if (empty($_POST)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Data kosong']);
            return;
        }

        $programs = [
            'id' => $id,
            'nama' => $_POST['name'],
            'status_pendaftaran' => $_POST['status_register'],
            'tgl_mulai_pendaftaran' => $_POST['start_date'],
            'tgl_akhir_pendaftaran' => $_POST['end_date'],
            'standar' => $_POST['standar'],
            'jml_peserta' => $_POST['participant'],
            'deskripsi' => $_POST['description'],
            'instructor_id' => $_POST['instructor_id'],
            'building_id' => $_POST['building_id'],
            'department_id' => $_POST['department_id'],
        ];

        if (isset($_FILES['image'])) {
            $uploadDir = 'Uploads/programs/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $programs['image_path'] = $uploadFile;
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal mengunggah gambar']);
                return;
            }
        }

        try {
            $programResult = $this->model->updatePrograms($programs);

            if ($programResult['success']) {
                $requirementsController = new RequirementsController();

                if (!empty($_POST['requirements'])) {
                    $result = $requirementsController->updateRequirements($_POST['requirements']);
                    if (!$result['success']) {
                        http_response_code(500);
                        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui persyaratan']);
                        return;
                    }
                }

                if (!empty($_POST['newRequirements'])) {
                    $result = $requirementsController->addNewRequirements($_POST['newRequirements'], $id);
                    if (!$result['success']) {
                        http_response_code(500);
                        echo json_encode(['success' => false, 'message' => 'Gagal menambah persyaratan baru']);
                        return;
                    }
                }

                if (!empty($_POST['deleteRequirements'])) {
                    $result = $requirementsController->deleteRequirements($_POST['deleteRequirements']);
                    if (!$result['success']) {
                        http_response_code(500);
                        echo json_encode(['success' => false, 'message' => 'Gagal menghapus persyaratan']);
                        return;
                    }
                }
                http_response_code(200);
                echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui', 'redirect' => '/programs']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $programResult['message']]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
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

    public function searchPrograms()
    {
        $name = $_GET['search'] ?? '';

        $programs = $this->model->searchPrograms($name);
        echo json_encode($programs);
    }
}