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
        $query  = "SELECT requirement FROM requirements WHERE program_id = :id";
        $stm = $this->connection->prepare($query);
        try {
            $stm->bindParam(':id', $id);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data tidak ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'requirements' => $data];
            }
        } catch (PDOException $e) {
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
}