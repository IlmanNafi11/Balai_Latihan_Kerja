<?php

class ToolsModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllTools()
    {
        $query = "SELECT * FROM tools";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function getToolsById($id)
    {
        $query = "SELECT * FROM tools WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return ['success' => true, 'dataByID' => $data];
            } else {
                return ['success' => false, 'message' => 'Data tidak Ditemukan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function createTools($name, $description, $type)
    {
        $query = "INSERT INTO tools(nama, deskripsi, tipe) VALUES(:name, :description, :type)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Disimpan', 'redirect_url' => '/tools'];
            } else {
                return ['success' => false, 'message' => 'Gagal Menyimpan Data'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateTools($id, $name, $description, $type)
    {
        $query = "UPDATE tools SET nama = :name, deskripsi = :description, tipe = :type WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Diperbarui', 'redirect_url' => '/tools'];
            } else {
                return ['success' => false, 'message' => 'Gagal Memperbarui Data'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function deleteTools($id)
    {
        $query = "DELETE FROM tools WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Berhasil Dihapus'];
            } else {
                return ['success' => false, 'message' => 'Gagal Menghapus Data'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }
}