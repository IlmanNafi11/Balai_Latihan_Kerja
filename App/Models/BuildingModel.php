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
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        $query = "UPDATE buildings SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        return $stmt->execute();
    }

    public function deleteBuilding($id)
    {
        $query = "DELETE FROM buildings WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}