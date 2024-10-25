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
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getInstituteId()
    {
        $query = "SELECT id FROM institute";
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return ['success' => false, 'message' => 'Gagal mengambil id insitute'];
        }
    }

    public function getInstituteById($id)
    {
        $query = "SELECT * FROM institute WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return ['success' => true, 'dataByID' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['success' => false, 'message' => 'Gagal mengambil data berdasarkan id insitute'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateInstitute($data = [])
    {
        $query = "UPDATE institute SET nama = :nama, pimpinan = :pimpinan, no_vin = :no_vin, no_sotk = :no_sotk, thn_berdiri = :thn_berdiri, tipe = :tipe, kepemilikan = :kepemilikan, status_beroperasi = :status_beroperasi, no_tlp = :no_tlp, no_fax = :no_fax, email = :email, website = :website, deskripsi = :deskripsi";
        $stmt = $this->connection->prepare($query);
        try {
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
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Data Institusi Berhasil Diperbaharui', 'redirect_url' => '/institute'];
            } else
            {
                return ['success' => false, 'message' => 'Data Institusi Gagal Diperbaharui'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}