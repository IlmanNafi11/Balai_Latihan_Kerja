<?php

class NotificationModel
{
    private $connection;

    function __construct($db)
    {
        $this->connection = $db;
    }

    public function getAllNotification()
    {
        $query = "SELECT * FROM notifications";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => "Data Kosong", 'notifications' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getNotificationById($id)
    {
        $query = "SELECT * FROM notifications WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                http_response_code(204);
                return ['success' => true, 'isEmpty' => true, 'message' => "Data Tidak Ditemukan", 'notifications' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createNotification($message)
    {
        $query = "INSERT INTO notifications (pesan, tipe) VALUES(:message, :tipe)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':message', $message);
            $stmt->bindValue(':tipe', 'publik');
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Notifikasi berhasil ditambahkan', 'redirect' => '/notification'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function deleteNotification($id)
    {
        $query = "DELETE FROM notifications WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Notifikasi berhasil dihapus', 'redirect' => '/notification'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }

    public function searchNotifications($search)
    {
        $query = "SELECT * FROM notifications WHERE pesan LIKE :search";
        $stmt = $this->connection->prepare($query);
        try {
            $search = '%' . $search . '%';
            $stmt->bindParam(":search", $search);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'notifications' => []];
            } else {
                http_response_code(200);
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}