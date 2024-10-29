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
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'instructors' => $data];
            }
        } catch (PDOException $e) {
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
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'instructor' => $data];
            }
        } catch (PDOException $e) {
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
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'instructors' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function createInstructor($nama, $no_telp, $email, $address)
    {
        $query = "INSERT INTO instructors (nama, no_tlp, email, alamat) VALUES (:nama, :no_tlp, :email, :alamat)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':alamat', $address);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data Berhasil Disimpan', 'redirect_url' => '/instructor'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateInstructor($id, $nama, $no_telp, $email, $address)
    {
        $query = "UPDATE instructors SET nama = :nama, no_tlp = :no_tlp, email = :email, alamat = :address WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data Berhasil Diperbarui', 'redirect_url' => '/instructor'];
        } catch (PDOException $e) {
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
            return ['success' => true, 'message' => 'Data Berhasil Dihapus', 'redirect_url' => '/instructor'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}