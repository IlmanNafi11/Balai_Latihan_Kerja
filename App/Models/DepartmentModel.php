<?php

class DepartmentModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllDepartment()
    {
        $query = "SELECT * FROM departments";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'departments' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }

    }

    public function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'department' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getDepartmentName()
    {
        $query = "SELECT id, nama FROM departments";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'departments' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createDepartment($nama, $deskripsi, $instituteID, $imagePath)
    {
        $query = "INSERT INTO departments (nama, deskripsi, institute_id, image_path) VALUES (:nama, :deskripsi, :institusi_id, :image_path)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":deskripsi", $deskripsi);
            $stmt->bindParam(":institusi_id", $instituteID);
            $stmt->bindParam(":image_path", $imagePath);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil disimpan', 'redirect_url' => '/department'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateDepartment($id, $nama, $deskripsi, $imagePath = null)
    {
        $query = "UPDATE departments SET nama = :nama, deskripsi = :deskripsi";

        if ($imagePath) {
            $query .= ", image_path = :image";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":deskripsi", $deskripsi);
            $stmt->bindParam(":id", $id);

            if ($imagePath) {
                $stmt->bindParam(":image", $imagePath);
            }

            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil diperbarui', 'redirect' => '/department'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteDepartment($id)
    {
        $query = "DELETE FROM departments WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data berhasil dihapus', 'redirect_url' => '/department'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getMostProgramsInDepartment()
    {
        $query = "SELECT departments.nama AS department_name, COUNT(programs.id) AS total_programs FROM departments JOIN programs ON departments.id = programs.department_id GROUP BY departments.id ORDER BY total_programs DESC LIMIT 5";
        $stmt = $this->connection->prepare($query);
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

    public function searchDepartment($search)
    {
        $query = "SELECT * FROM departments WHERE nama LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'departments' => []];
            } else {
                return ['success' => true, 'isEmpty' => false, 'departments' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}