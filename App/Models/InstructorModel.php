<?php

class InstructorModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllInstructor()
    {
        $query = "SELECT * FROM instructors";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'instructors' => []];
            } else {
                return ['success' => true, 'isEmpty' => false, 'instructors' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInstructorById($id)
    {
        $query = "SELECT * FROM instructors WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'instructor' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInstructorName()
    {
        $query = "SELECT id, nama FROM instructors";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'instructors' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createInstructor($nama, $no_telp, $email, $address, $imagePath)
    {
        $query = "INSERT INTO instructors (nama, no_tlp, email, alamat, image_path) VALUES (:nama, :no_tlp, :email, :alamat, :path)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':alamat', $address);
            $stmt->bindParam(':path', $imagePath);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Disimpan', 'redirect' => '/instructor'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateInstructor($id, $nama, $no_telp, $email, $address, $imagePath = null)
    {
        $query = "UPDATE instructors SET nama = :nama, no_tlp = :no_tlp, email = :email, alamat = :address";
        if ($imagePath) {
            $query .= ", image_path = :image";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':id', $id);

            if ($imagePath) {
                $stmt->bindParam(":image", $imagePath);
            }

            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Diperbarui', 'redirect' => '/instructor'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteInstructor($id)
    {
        $query = "DELETE FROM instructors WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Dihapus', 'redirect' => '/instructor'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function searchInstructors($search)
    {
        $query = "SELECT * FROM instructors WHERE nama LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'instructors' => []];
            } else {
                return ['success' => true, 'isEmpty' => false, 'instructors' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}