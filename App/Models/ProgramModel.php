<?php

class ProgramModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllProgram() // Notes
    {
        $query = "SELECT programs.*, buildings.nama AS building_name, instructors.nama AS instructor_name, departments.nama AS department_name FROM programs JOIN buildings ON programs.building_id = buildings.id JOIN instructors ON programs.instructor_id = instructors.id JOIN departments ON programs.department_id = departments.id ORDER BY programs.id ASC";
        $stmt = $this->connection->prepare($query);
        try {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return ['success' => false, 'message' => 'Data Kosong'];
            }

        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getProgramByIdForUpdate($id)
    {
        $query = "SELECT * FROM programs WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data)) {
                return ['success' => true, 'isEmpty' => false, 'programs' => $data];
            } else {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak ditemukan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getProgramsByDepartment($id)
    {
        $query = "SELECT id, nama, deskripsi FROM programs WHERE department_id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'programs' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getProgramsById($id)
    {
        $query = "SELECT programs.*, buildings.nama AS building_name, departments.nama AS department_name, instructors.nama AS instructor_name, instructors.no_tlp AS instructors_contact, instructors.alamat AS instructors_address FROM programs LEFT JOIN buildings ON programs.building_id = buildings.id LEFT JOIN departments ON programs.department_id = departments.id LEFT JOIN instructors ON programs.instructor_id = instructors.id WHERE programs.id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return ['success' => true, 'isEmpty' => false, 'programs' => $data];
            } else {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak ditemukan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createProgram($data = [])
    {
        require_once '../App/Controllers/RequirementsController.php';
        $query = "INSERT INTO programs (nama, status_pendaftaran, tgl_mulai_pendaftaran, tgl_akhir_pendaftaran, standar, jml_peserta, deskripsi, instructor_id, building_id, department_id) VALUES (:name, :status_pendaftaran, :tgl_mulai, :tgl_akhir, :standar, :jml_peserta, :deskripsi, :instructor_id, :building_id, :department_id)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $data['nama']);
            $stmt->bindParam(":status_pendaftaran", $data['status_pendaftaran']);
            $stmt->bindParam(":tgl_mulai", $data['tgl_mulai_pendaftaran']);
            $stmt->bindParam(":tgl_akhir", $data['tgl_akhir_pendaftaran']);
            $stmt->bindParam(":standar", $data['standar']);
            $stmt->bindParam(":jml_peserta", $data['jml_peserta']);
            $stmt->bindParam(":deskripsi", $data['deskripsi']);
            $stmt->bindParam(":instructor_id", $data['instructor_id']);
            $stmt->bindParam(":building_id", $data['building_id']);
            $stmt->bindParam(":department_id", $data['department_id']);
            $stmt->execute();
            $programId = $this->connection->lastInsertId();

            $requirementsController = new RequirementsController();
            $insertRequirements = $requirementsController->createRequirements($programId, $data['requirements']);
            if ($insertRequirements['success']) {
                return ['success' => true, 'message' => 'Data berhasil disimpan', 'redirect_url' => '/programs'];
            } else {
                return ['success' => false, 'message' => $insertRequirements['message']];
            }
        } catch (PDOException|Exception $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updatePrograms($data = [])
    {
        $query = "UPDATE programs SET nama = :name, status_pendaftaran = :status_register, tgl_mulai_pendaftaran = :start_date, tgl_akhir_pendaftaran = :end_date, standar = :standar, jml_peserta = :participants, deskripsi = :descriptions, instructor_id = :instructor_id, building_id = :building_id, department_id = :department_id WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $data['nama']);
            $stmt->bindParam(":status_register", $data['status_pendaftaran']);
            $stmt->bindParam(":start_date", $data['tgl_mulai_pendaftaran']);
            $stmt->bindParam(":end_date", $data['tgl_akhir_pendaftaran']);
            $stmt->bindParam(":standar", $data['standar']);
            $stmt->bindParam(":participants", $data['jml_peserta']);
            $stmt->bindParam(":descriptions", $data['deskripsi']);
            $stmt->bindParam(":instructor_id", $data['instructor_id']);
            $stmt->bindParam(":building_id", $data['building_id']);
            $stmt->bindParam(":department_id", $data['department_id']);
            $stmt->bindParam(":id", $data['id']);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil diupdate', 'redirect_url' => '/programs'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getLine() + error_log($e->getMessage())];
        }
    }

    public function deletePrograms($id)
    {
        $query = "DELETE FROM programs WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil dihapus', 'redirect_url' => '/programs'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getFavoritePrograms()
    {
        $query = "SELECT programs.nama AS program_name, COUNT(registrations.id) AS total_registrations FROM registrations JOIN programs ON registrations.program_id = programs.id WHERE registrations.registration_year = YEAR(NOW()) GROUP BY programs.id ORDER BY total_registrations DESC LIMIT 5";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'data' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}