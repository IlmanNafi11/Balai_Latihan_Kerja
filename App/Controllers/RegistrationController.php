<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/RegistrationsModel.php';

class RegistrationController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new RegistrationsModel($db);
    }

    public function index()
    {
        require_once "../App/Views/Registers/registrantData.php";
    }

    public function getRegistrationsSummary()
    {
        echo json_encode($this->model->getRegistrationsSummary());
    }

    public function registrationsPrograms()
    {
        require_once '../App/Controllers/ProgramController.php';

        $userId = $_POST['id_pengguna'];
        $nama = $_POST['nama'];
        $programId = $_POST['id_program'];
        $namaProgram = $_POST['nama_program'];
        $registrationNumber = generateRegistrationNumber();
        $tahunSekarang = date("Y");
        $isSucces = true;
        $uploadDir = "Uploads/registration_files/$namaProgram/$nama-$registrationNumber/";

        if (empty($userId) && empty($programId) && empty($namaProgram) && empty($nama)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            http_response_code(400);
            return;
        }

        $programController = new ProgramController();
        $program = $programController->getProgramById($programId);
        if (!$program['isEmpty']) {
            $departmentId = $program['programs'][0]['department_id'];
        }

        $isRegisters = $this->model->checkRegistration($userId, $tahunSekarang);

        if ($isRegisters) {
            $programTerdaftar = $programController->getProgramById($isRegisters['program_id']);
            $departmentIdTerdaftar = $programTerdaftar['programs'][0]['department_id'];
            if ($departmentIdTerdaftar != $departmentId) {
                echo json_encode(['success' => false, 'message' => 'Anda sudah terdaftar di program lain pada tahun yang sama. Pendaftaran hanya diperbolehkan untuk program dalam departemen yang sama.']);
                http_response_code(400);
                exit();
            }
        }

        if (isset($_FILES['ktp_pdf'])) {
            $isSucces = $this->uploadFile($_FILES['ktp_pdf'], $uploadDir, 'ktp.pdf') && $isSucces;
        }

        if (isset($_FILES['kk_pdf'])) {
            $isSucces = $this->uploadFile($_FILES['kk_pdf'], $uploadDir, 'kk.pdf') && $isSucces;
        }

        if (isset($_FILES['ijazah_pdf'])) {
            $isSucces = $this->uploadFile($_FILES['ijazah_pdf'], $uploadDir, 'ijazah.pdf') && $isSucces;
        }

        if ($isSucces) {
            echo json_encode($this->model->insertRegistration($userId, $programId, $uploadDir, $tahunSekarang, $registrationNumber));
            http_response_code(200);
        }
    }

    private function uploadFile($file, $uploadDir, $newFileName)
    {

        if ($file['type'] !== 'application/pdf') {
            echo json_encode(['success' => false, 'message' => 'Format file harus berupa .pdf']);
            http_response_code(400);
            exit();
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if ($file['error'] === 0) {
            $destination = $uploadDir . $newFileName;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                return true;
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal dalam menyimpan file ' . $newFileName]);
                http_response_code(500);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => $file['error']]);
            http_response_code(400);
            exit();
        }
    }

    public function updateStatusRegistration($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $status = $data['status'];
        echo json_encode($this->model->updateStatusRegistration($id, $status));
    }

    public function deleteRegistration($id)
    {
        echo json_encode($this->model->deleteRegistration($id));
    }

    public function searchRegistrationsData()
    {
        $registrationNumber = $_GET['search'] ?? '';
        echo json_encode($this->model->searchRegistrations($registrationNumber));
    }

    public function getAllRegistrationsData()
    {
        echo json_encode($this->model->getAllRegistration());
    }

    public function downloadBerkas()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['path'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Folder path tidak disediakan']);
            exit();
        }

        $folderPath = $input['path'];
        $fullFolderPath = $_SERVER['DOCUMENT_ROOT'] . "/$folderPath";

        if (!is_dir($fullFolderPath)) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Folder tidak ditemukan', 'path' => $fullFolderPath]);
            exit();
        }

        $userFolderName = basename($fullFolderPath);

        $zipFileName = sys_get_temp_dir() . '/folder.zip';
        $zip = new ZipArchive();

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $files = scandir($fullFolderPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $fullFolderPath . '/' . $file;
                    if (is_file($filePath)) {
                        $zip->addFile($filePath, $userFolderName . '/' . $file);
                    }
                }
            }
            $zip->close();

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="berkas.zip"');
            header('Content-Length: ' . filesize($zipFileName));
            readfile($zipFileName);

            unlink($zipFileName);
            exit();
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal membuat file zip']);
            exit();
        }
    }

}