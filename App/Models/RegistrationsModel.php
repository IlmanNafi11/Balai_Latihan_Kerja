<?php

class RegistrationsModel
{
    private $connections;

    public function __construct($db)
    {
        $this->connections = $db;
    }

    public function getRegistrationsSummary()
    {
        $query = "SELECT registration_year AS year, COUNT(*) AS total 
                            FROM registrations WHERE registration_year >= YEAR(NOW()) - 4
                            GROUP BY registration_year 
                            ORDER BY registration_year ASC";
        $stmt = $this->connections->prepare($query);
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

    public function insertRegistration($userId, $program_id, $form_path, $year, $registrationNumber, $status = 'Ditunda')
    {
        $query = "INSERT INTO registrations (user_id, program_id, status, form_path, registration_year, registration_number) VALUES (:user_id, :program_id, :status, :form_path, :year, :registration_number)";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':program_id', $program_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':form_path', $form_path);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':registration_number', $registrationNumber);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Registrasi berhasil', 'no_register' => $registrationNumber];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function checkRegistration($userId, $registrationYear)
    {
        $query = "SELECT * FROM registrations WHERE user_id = :user_id AND registration_year = :year AND status = 'Diterima'";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':year', $registrationYear);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            http_response_code(500);
        }
    }

    public function updateStatusRegistration($id, $status)
    {
        $query = "UPDATE registrations SET status = :status WHERE id = :id";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Status berhasil diperbarui', 'redirect' => '/registration'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteRegistration($id)
    {
        $query = "DELETE FROM registrations WHERE id = :id";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data berhasil dihapus', 'redirect' => '/registration'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function searchRegistrations($search)
    {
        $query = "SELECT registrations.*, users.id AS user_id, users.nama AS nama_user, programs.nama AS nama_program FROM registrations JOIN users ON registrations.user_id = users.id JOIN programs ON registrations.program_id = programs.id WHERE registrations.registration_number LIKE :search OR users.nama LIKE :search";
        $stmt = $this->connections->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'registrations' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'registrations' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllRegistration()
    {
        $query = "SELECT registrations.*, users.id AS user_id, users.nama AS nama_user, programs.nama AS nama_program FROM registrations JOIN users ON registrations.user_id = users.id JOIN programs ON registrations.program_id = programs.id";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'registrations' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'registrations' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}