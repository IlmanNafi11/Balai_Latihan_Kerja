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

    public function getProgramById($id)
    {
        return $this->model->getProgramById($id);
    }

    public function getProgramsByIdForUpdate($id)
    {
        require_once '../App/Controllers/RequirementsController.php';
        require_once '../App/Controllers/ToolsController.php';
        $programs = $this->model->getProgramById($id);
        if ($programs['success'] && !$programs['isEmpty']) {
            $requirementsController = new RequirementsController();
            $toolsController = new ToolsController();
            $requirements = $requirementsController->getRequirementsProgram($id);
            $tools = $toolsController->getToolsByProgram($id);
            if ($requirements['success'] && !$requirements['isEmpty'] && $tools['success'] && !$tools['isEmpty']) {
                $programs['requirements'] = $requirements['requirements'];
                $programs['tools'] = $tools['tools'];
                http_response_code(200);
                echo json_encode($programs);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Data Alat/requirement tidak ditemukan']);
            }
        } else {
            http_response_code(404);
            echo json_encode($programs);
        }
    }

    public function getProgramsDetail($id)
    {
        echo json_encode($this->model->getProgramsDetail($id));
    }

    public function getProgramsByDepartment($id)
    {
        echo json_encode($this->model->getProgramsByDepartment($id));
    }

    public function createPrograms()
    {
        require_once '../App/Controllers/RequirementsController.php';
        require_once '../App/Controllers/ToolsController.php';
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
        $requirements = $_POST['requirements'];
        $tools = $_POST['tools'];

        if (empty($name) || empty($status_pendaftaran) || empty($tgl_mulai_pendaftaran) || empty($tgl_akhir_pendaftaran) || empty($standar) || empty($jml_peserta) || empty($deskripsi) || empty($instructor_id) || empty($building_id) || empty($department_id) || empty($requirements) || empty($tools)) {
            http_response_code(400);
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
                    'image_path' => $filePath
                ];

                $programId = $this->model->createProgram($programs);
                $requirementsController = new RequirementsController();
                $insertRequirements = $requirementsController->createRequirements($programId, $requirements);
                if ($insertRequirements['success']) {
                    $toolsController = new ToolsController();
                    $resultTools = $toolsController->insertProgramTools($tools, $programId);
                    if ($resultTools) {
                        http_response_code(200);
                        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan', 'redirect' => '/programs']);
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => $insertRequirements['message']]);
                }
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal dalam memindahkan directory penyimpanan foto']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $image['error']]);
        }
    }

    public function updatePrograms($id)
    {
        require_once '../App/Controllers/RequirementsController.php';
        require_once '../App/Controllers/ToolsController.php';

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
        $requirements = $_POST['requirements'];
        $currentTools = $_POST['current_tools'];
        $deletedTools = $_POST['initial_tools'];

        if (empty($name) || empty($status_pendaftaran) || empty($tgl_mulai_pendaftaran) || empty($tgl_akhir_pendaftaran) || empty($standar) || empty($jml_peserta) || empty($deskripsi) || empty($instructor_id) || empty($building_id) || empty($department_id) || empty($requirements) || empty($currentTools)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Data Tidak Lengkap']);
            return;
        }

        $programs = [
            'id' => $id,
            'nama' => $name,
            'status_pendaftaran' => $status_pendaftaran,
            'tgl_mulai_pendaftaran' => $tgl_mulai_pendaftaran,
            'tgl_akhir_pendaftaran' => $tgl_akhir_pendaftaran,
            'standar' => $standar,
            'jml_peserta' => $jml_peserta,
            'deskripsi' => $deskripsi,
            'instructor_id' => $instructor_id,
            'building_id' => $building_id,
            'department_id' => $department_id,
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
        $programResult = $this->model->updatePrograms($programs);

        if ($programResult) {
            $requirementsController = new RequirementsController();
            $toolsController = new ToolsController();

            if (!empty($deletedTools)) {
                $resultDeleteTools = $toolsController->deleteProgramTools(json_decode($deletedTools), $id);
                if (!$resultDeleteTools) {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => 'Gagal menghapus tools']);
                    return;
                }
            }

            $UpdateProgramTools = $toolsController->insertProgramTools(json_decode($currentTools), $id);
            if (!$UpdateProgramTools) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui tools']);
                return;
            }

            $resultRequirements = $requirementsController->updateRequirements($requirements);
            if (!$resultRequirements) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui persyaratan']);
                return;
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
            echo json_encode(['success' => false, 'message' => 'Gagal Memperbarui Data Program']);
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