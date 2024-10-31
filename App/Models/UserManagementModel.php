<?php

class UserManagementModel
{
    private $connection;
    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'users' => $data];
            }

        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data kosong'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'user' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createUsers($data = [])
    {
        $query = "INSERT INTO users (nama, email, password, tlp, tanggal_lahir, jenis_kelamin, alamat, role) VALUES (:name, :email, :password, :phone, :tanggal_lahir, :jenis_kelamin, :alamat, :role)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':name', $data['nama']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':phone', $data['tlp']);
            $stmt->bindParam(':tanggal_lahir', $data['tanggal_lahir']);
            $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
            $stmt->bindParam(':alamat', $data['alamat']);
            $stmt->bindParam(':role', $data['role']);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data user berhasil disimpan'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateUsers($id, $name, $phone, $address)
    {
        $query = "UPDATE users SET nama = :name, tlp = :phone, alamat = :address WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data user berhasil diperbarui'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateAdmin($id, $name, $phone, $address, $password, $tanggalLahir)
    {
        $query = "UPDATE users SET nama = :name, tlp = :phone, alamat = :address, tanggal_lahir = :tanggal_lahir, password = :password WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':tanggal_lahir', $tanggalLahir);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data admin berhasil diperbarui'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteUsers($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data user berhasil dihapus'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}