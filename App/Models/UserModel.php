<?php

class UserModel
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function cekEmail($email)
    {
        $query = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return ['isEmpty' => false, 'success' => false, 'message' => 'Email sudah terdaftar'];
            } else {
                return ['isEmpty' => true, 'success' => true, 'message' => 'Email belum terdaftar'];
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

    public function getImageById($id)
    {
        $query = "SELECT profile_picture FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(404);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data tidak ditemukan', 'path' => ''];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'path' => $data['profile_picture']];
            }
        } catch (PDOException $e) {
            http_response_code(500);
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
            return ['success' => true, 'message' => 'Registrasi Berhasil', 'redirect' => '/user'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateUsers($id, $name, $phone, $address, $profile_picture = null)
    {
        $query = "UPDATE users SET nama = :name, tlp = :phone, alamat = :address";
        if ($profile_picture) {
            $query .= ", profile_picture = :path_profile";
        }
        $query .= " WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            if ($profile_picture) {
                $stmt->bindParam(':path_profile', $profile_picture);
            }
            $stmt->execute();
            return ['success' => true, 'message' => 'Profile berhasil diperbarui'];
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
            return ['success' => true, 'message' => 'Data user berhasil dihapus', 'redirect' => '/user'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function validateEmailUser($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(401);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Email tidak terdaftar'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'message' => 'Email terdaftar', 'users' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function insertOtp($user_id, $email, $otp, $expired)
    {
        $query = "INSERT INTO password_resets (user_id, email, otp_code, expires_at) VALUES (:user_id, :email, :otp, :expired)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':otp', $otp);
            $stmt->bindParam(':expired', $expired);
            $stmt->execute();
            return ['success' => true, 'message' => 'Kode OTP Berhasil disimpan di database'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getOtp($id)
    {
        $query = "SELECT otp_code, expires_at FROM password_resets WHERE user_id = :id ORDER BY expires_at DESC LIMIT 1";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(401);
                return ['success' => true, 'isEmpty' => true, 'message' => 'User tidak ditemukan'];
            } else {
                return ['success' => true, 'isEmpty' => false, 'message' => 'User ditemukan', 'users' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updatePassword($password, $id)
    {
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['success' => true, 'message' => 'Password berhasil diperbarui', 'redirect' => '/login'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Password gagal diperbarui' . $e->getMessage()];
        }
    }

    public function getUsersByRole($role)
    {
        $query = "SELECT * FROM users WHERE role IN ($role)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data kosong', 'users' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'users' => $data];
            }

        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function searchUsersByRole($search, $role)
    {
        $query = "SELECT * FROM users WHERE role IN ($role) AND nama LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'users' => []];
            } else {
                return ['success' => true, 'isEmpty' => false, 'users' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}