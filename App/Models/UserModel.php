<?php
class UserModel
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

    public function getUsersById($id)
    {
        $query = "SELECT id, nama, email, tlp, tanggal_lahir, jenis_kelamin, alamat, role, profile_picture FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data tidak ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'users' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createUsers($data = [])
    {
        $query = "INSERT INTO users (nama, email, password, tlp, tanggal_lahir, jenis_kelamin, alamat, role, profile_picture) VALUES (:name, :email, :password, :phone, :tanggal_lahir, :jenis_kelamin, :alamat, :role, :profile_picture)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':tanggal_lahir', $data['tanggal_lahir']);
            $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
            $stmt->bindParam(':alamat', $data['alamat']);
            $stmt->bindParam(':role', $data['role']);
            $stmt->bindParam(':profile_picture', $data['foto_path']);
            $stmt->execute();
            return ['success' => true, 'message' => 'Data user berhasil disimpan', 'redirect_url' => '/user'];
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

    public function updateAdmin($id, $name, $phone, $address)
    {
        $query = "UPDATE users SET nama = :name, tlp = :phone, alamat = :address WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
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