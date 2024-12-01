<?php
class LandingPageModel
{
    private $connection;
    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getSummaryStatSection()
    {
        $query = "SELECT (SELECT COUNT(*) FROM registrations WHERE status = 'Diterima') AS total_peserta, (SELECT COUNT(*) FROM programs) AS total_programs, (SELECT COUNT(*) FROM instructors) AS total_instructors";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['success' => true, 'data' => $data, 'isEmpty' => false];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage(), 'isEmpty' => true];
        }
    }
}