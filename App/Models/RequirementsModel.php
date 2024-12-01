<?php

class RequirementsModel
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getRequirementsByProgram($id)
    {
        $query = "SELECT * FROM requirements WHERE program_id = :id";
        $stm = $this->connection->prepare($query);
        try {
            $stm->bindParam(':id', $id);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data requirements tidak ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'requirements' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createRequirements($programId, $requirement)
    {
        $query = "INSERT INTO requirements (program_id, requirement) VALUES (:program_id, :requirement)";
        $stm = $this->connection->prepare($query);
        try {
            $stm->bindParam(':program_id', $programId);
            $stm->bindParam(':requirement', $requirement);
            $stm->execute();
            return ['success' => true, 'isEmpty' => false, 'message' => 'Reuirement berhasil disimpan'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateRequirements($requirementId, $requirement)
    {
        $query = "UPDATE requirements SET requirement = :requirement WHERE  id = :id";
        $stm = $this->connection->prepare($query);
        try {
            $stm->bindParam(':id', $requirementId);
            $stm->bindParam(':requirement', $requirement);
            $stm->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteRequirements($id)
    {
        $query = "DELETE FROM requirements WHERE id = :id";
        $stm = $this->connection->prepare($query);
        try {
            $stm->bindParam(':id', $id);
            $stm->execute();
            return ['success' => true, 'message' => 'Requirements Berhasil dihapus'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}