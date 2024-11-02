<?php

class ProgramModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllProgram()
    {
        $query = "SELECT programs.*, buildings.nama AS building_name, instructors.nama AS instructor_name, departments.nama AS department_name FROM programs JOIN buildings ON programs.building_id = buildings.id JOIN instructors ON programs.instructor_id = instructors.id JOIN departments ON programs.department_id = departments.id ORDER BY programs.id ASC";
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

    public function getProgramById($id)
    {
        $query = "SELECT programs.*, buildings.nama AS building_name, instructors.nama AS instructor_name, departments.nama AS department_name FROM programs JOIN buildings ON programs.building_id = buildings.id JOIN instructors ON programs.instructor_id = instructors.id JOIN departments ON programs.department_id = departments.id WHERE programs.id = :id ORDER BY programs.id ASC";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['success' => true, 'dataByID' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['success' => false, 'message' => 'Data Tidak ditemukan'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}