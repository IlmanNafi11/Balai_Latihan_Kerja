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
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'buildings' => $data];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'buildings' => []];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'isEmpty' => true, 'message' => $e->getMessage()];
        }
    }

    public function getBuildingById($id)
    {
        $query = "SELECT * FROM buildings WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'buildings' => $data];
            } else {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => "Data tidak ditemukan"];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function getBuildingName()
    {
        $query = "SELECT id, nama FROM buildings";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                http_response_code(200);
                return ["success" => true, 'isEmpty' => false, "buildings" => $data];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function createBuilding($name, $description)
    {
        $query = "INSERT INTO buildings (nama, deskripsi) VALUES (:name, :description)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data berhasil disimpan', 'redirect' => '/building'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi kesalahan : ' . $e->getMessage()];
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
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data berhasil diperbarui', 'redirect' => '/building'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi kesalahan : ' . $e->getMessage()];
        }
    }

    public function deleteBuilding($id)
    {
        $query = "DELETE FROM buildings WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Gedung berhasil dihapus', 'redirect' => '/building'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi kesalahan : ' . $e->getMessage()];
        }
    }

    public function searchBuildings($search)
    {
        $query = "SELECT * FROM buildings WHERE nama LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'buildings' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'buildings' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}