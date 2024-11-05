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

    public function getProgramById($id) // Notes
    {
        $query = "SELECT programs.*, buildings.nama AS building_name, instructors.nama AS instructor_name, departments.nama AS department_name FROM programs JOIN buildings ON programs.building_id = buildings.id JOIN instructors ON programs.instructor_id = instructors.id JOIN departments ON programs.department_id = departments.id WHERE programs.id = :id ORDER BY programs.id ASC";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['success' => true, 'dataByID' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['success' => false, 'message' => 'Data Tidak ditemukan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getProgramsByDepartment($id)
    {
        $query  = "SELECT id, nama, deskripsi FROM programs WHERE department_id = :id";
        $stmt   = $this->connection->prepare($query);
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
            if ($data){
                return['success' => true, 'isEmpty' => false, 'programs' => $data];
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
}