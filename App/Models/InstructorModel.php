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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            if ($stmt->execute()) {
                return ['success' => true, 'dataByID' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['success' => false, 'message' => 'Data Tidak Ditemukan'];
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
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return ['success' => false, 'message' => 'Data Kosong'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createInstructor($nama, $no_telp, $email,$address)
    {
        $query = "INSERT INTO instructors (nama, no_tlp, email, alamat) VALUES (:nama, :no_tlp, :email, :alamat)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':alamat', $address);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Disimpan', 'redirect_url' => '/instructor'];
            } else {
                return ['success' => false, 'message' => 'Data Gagal Disimpan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateInstructor($id, $nama, $no_telp, $email)
    {
        $query = "UPDATE instructors SET nama = :nama, no_tlp = :no_tlp, email = :email WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_tlp', $no_telp);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Diperbarui'];
            } else {
                return ['success' => false, 'message' => 'Data Gagal Diperbarui'];
            }
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
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Dihapus'];
            } else {
                return ['success' => false, 'message' => 'Data Gagal Dihapus'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}