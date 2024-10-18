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
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getDepartmentById($id)
{
    $query = "SELECT * FROM departments WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function createDepartment($nama, $deskripsi, $instituteID)
{
    $query = "INSERT INTO departments (nama, deskripsi, institusi_id) VALUES (:nama, :deskripsi, :institusi_id)";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(":nama", $nama);
    $stmt->bindParam(":deskripsi", $deskripsi);
    $stmt->bindParam(":institusi_id", $instituteID);
    return $stmt->execute();
}

public function updateDepartment($id, $nama, $deskripsi)
{
    $query = "UPDATE departments SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(":nama", $nama);
    $stmt->bindParam(":deskripsi", $deskripsi);
    $stmt->bindParam(":id", $id);
    return $stmt->execute();
}

public function deleteDepartment($id)
{
    $query = "DELETE FROM departments WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(":id", $id);
    return $stmt->execute();
}
}