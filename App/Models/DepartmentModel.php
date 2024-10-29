<?php

class DepartmentModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllDepartment()
    {
        $query = "SELECT * FROM departments";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'departments' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }

    }

    public function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'department' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getDepartmentName()
    {
        $query = "SELECT id, nama FROM departments";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'departments' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createDepartment($nama, $deskripsi, $instituteID)
    {
        $query = "INSERT INTO departments (nama, deskripsi, institute_id) VALUES (:nama, :deskripsi, :institusi_id)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":deskripsi", $deskripsi);
            $stmt->bindParam(":institusi_id", $instituteID);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil ditambahkan', 'redirect_url' => '/department'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateDepartment($id, $nama, $deskripsi)
    {
        $query = "UPDATE departments SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":deskripsi", $deskripsi);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil diperbarui', 'redirect_url' => '/department'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteDepartment($id)
    {
        $query = "DELETE FROM departments WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil dihapus', 'redirect_url' => '/department'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}