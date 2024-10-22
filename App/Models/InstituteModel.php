<?php

class InstituteModel
{
    private $connection;
    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllInstituteData()
    {
        $query = "SELECT * FROM institusi";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateInstitute($data = [])
    {
        $query = "UPDATE institute SET nama = :nama, pimpinan = :pimpinan, no_vin = :no_vin, no_sotk = :no_sotk, thn_berdiri = :thn_berdiri, tipe = :tipe, kepemilikan = :kepemilikan, status_beroperasi = :status_beroperasi, no_tlp = :no_tlp, no_fax = :no_fax, email = :email, website = :website, deskripsi = :deskripsi";
        $stmt = $this->connection->prepare($query);
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
        return $stmt->execute();
    }
}