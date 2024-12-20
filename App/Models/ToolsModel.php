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
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'tools' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'tools' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function getToolsById($id)
    {
        $query = "SELECT * FROM tools WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'tools' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function getToolsByPrograms($id)
    {
        $query = "SELECT * FROM program_tools WHERE program_id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'tools' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function getToolsName()
    {
        $query = "SELECT id, nama FROM tools";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'tools' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }

    }

    public function insertProgramsTools($toolsId, $programId)
    {
        $query = "INSERT INTO program_tools (tool_id, program_id) VALUES(:tools_id, :program_id)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":tools_id", $toolsId);
            $stmt->bindParam(":program_id", $programId);
            $stmt->execute();
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
        return true;
    }

    public function createTools($name, $description, $type)
    {
        $query = "INSERT INTO tools(nama, deskripsi, tipe) VALUES(:name, :description, :type)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Disimpan', 'redirect' => '/tools'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
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
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Diperbarui', 'redirect' => '/tools'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function deleteTools($id)
    {
        $query = "DELETE FROM tools WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil Dihapus', 'redirect' => '/tools'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function deleteProgramsTools($toolsId, $programId)
    {
        $query = "DELETE FROM program_tools WHERE tool_id = :toolsId AND program_id = :programId";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":toolsId", $toolsId);
            $stmt->bindParam(":programId", $programId);
            $stmt->execute();
            http_response_code(200);
            return true;
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    public function searchTools($search)
    {
        $query = "SELECT * FROM tools WHERE nama LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'tools' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'tools' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}