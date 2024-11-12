<?php

class RegistrationsModel
{
    private $connections;

    public function __construct($db)
    {
        $this->connections = $db;
    }

    public function getRegistrationsSummary()
    {
        $query = "SELECT registration_year AS year, COUNT(*) AS total 
                            FROM registrations WHERE registration_year >= YEAR(NOW()) - 4
                            GROUP BY registration_year 
                            ORDER BY registration_year ASC";
        $stmt = $this->connections->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'data' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}