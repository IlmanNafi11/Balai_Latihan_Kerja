<?php

class DashboardModel
{
    private $connections;

    public function __construct($db)
    {
        $this->connections = $db;
    }

    public function getSummary()
    {
        $query = "SELECT 'departments' AS table_name, COUNT(*) AS total FROM departments UNION ALL SELECT 'programs' AS table_name, COUNT(*) AS total FROM programs UNION ALL SELECT 'instructors' AS table_name, COUNT(*) AS total FROM instructors UNION ALL SELECT 'buildings' AS table_name, COUNT(*) AS total FROM buildings UNION ALL SELECT 'tools' AS table_name, COUNT(*) AS total FROM tools";
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
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}