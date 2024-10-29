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
                return ['success' => true, 'isEmpty' => true, 'message' => "Data Kosong"];
            } else {
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
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
                return ['success' => true, 'isEmpty' => true, 'message' => "Data Tidak Ditemukan"];
            } else {
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
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
            return ['success' => true, 'message' => 'Notifikasi berhasil ditambahkan', 'redirect_url' => '/notification'];
        } catch (PDOException $e) {
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
            return ['success' => true, 'message' => 'Notifikasi berhasil dihapus', 'redirect_url' => '/notification'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }
}