<?php

class BuildingModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllBuilding()
    {
        $query = "SELECT * FROM buildings";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBuildingById($id)
    {
        $query = "SELECT * FROM buildings WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $dataByID = $stmt->fetch(PDO::FETCH_ASSOC);
                return ['success' => true, 'dataByID' => $dataByID];
            } else {
                return ['success' => false, 'message' => 'Data tidak ditemukan'];
            }
        }catch (PDOException $e){
            return ['success' => false, 'message' => 'Terjadi Kesalahan' . $e->getMessage()];
        }
    }

    public function createBuilding($name, $description)
    {
        $query = "INSERT INTO buildings (nama, deskripsi) VALUES (:name, :description)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Gedung berhasil ditambahkan', 'redirect_url' => '/building'];
            } else {
                return ['success' => false, 'message' => 'Gedung gagal ditambahkan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateBuilding($id, $name, $description)
    {
        $query = "UPDATE buildings SET nama = :name, deskripsi = :description WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Gedung berhasil diubah', 'redirect_url' => '/building'];
            } else {
                return ['success' => false, 'message' => 'Gedung gagal diubah'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function deleteBuilding($id)
    {
        $query = "DELETE FROM buildings WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data gedung berhasil dihapus', 'redirect_url' => '/building'];
            } else {
                return ['success' => false, 'message' => 'Data Gedung gagal hapus'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }
}