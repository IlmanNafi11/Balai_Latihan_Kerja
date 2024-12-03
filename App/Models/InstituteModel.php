<?php

class InstituteModel
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllInstitute()
    {
        $query = "SELECT * FROM institute";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'institutes' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function getInstituteId()
    {
        $query = "SELECT id FROM institute";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'institutes' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            ['success' => false, 'message' => 'Terjadi Kesalahan : ' . $e->getMessage()];
        }
    }

    public function getInstituteById($id)
    {
        $query = "SELECT * FROM institute WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Tidak Ditemukan'];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'institutes' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateInstitute($data = [])
    {
        $query = "UPDATE institute SET nama = :nama, pimpinan = :pimpinan, no_vin = :no_vin, no_sotk = :no_sotk, thn_berdiri = :thn_berdiri, tipe = :tipe, kepemilikan = :kepemilikan, status_beroperasi = :status_beroperasi, no_tlp = :no_tlp, no_fax = :no_fax, email = :email, website = :website, deskripsi = :deskripsi WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':pimpinan', $data['pimpinan']);
            $stmt->bindParam(':no_vin', $data['no_vin']);
            $stmt->bindParam(':no_sotk', $data['no_sotk']);
            $stmt->bindParam(':thn_berdiri', $data['thn_berdiri']);
            $stmt->bindParam(':tipe', $data['tipe']);
            $stmt->bindParam(':kepemilikan', $data['kepemilikan']);
            $stmt->bindParam(':status_beroperasi', $data['status_beroperasi']);
            $stmt->bindParam(':no_tlp', $data['no_tlp']);
            $stmt->bindParam(':no_fax', $data['no_fax']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':website', $data['website']);
            $stmt->bindParam(':deskripsi', $data['deskripsi']);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Data Berhasil diperbarui', 'redirect_url' => '/institute'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}