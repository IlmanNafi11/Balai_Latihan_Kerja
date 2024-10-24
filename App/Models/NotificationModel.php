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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getNotificationById($id)
    {
        $query = "SELECT * FROM notifications WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                $dataByID = $stmt->fetch(PDO::FETCH_ASSOC);
                return ['success' => true, 'dataByID' => $dataByID];
            } else {
                return ['success' => false, 'message' => 'Data tidak ditemukan'];
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
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Notification berhasil ditambahkan', 'redirect_url' => '/notification'];
            } else {
                return ['success' => false, 'message' => 'Notification gagal ditambahkan'];
            }
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
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Notification berhasil dihapus', 'redirect_url' => '/notification'];
            } else {
                return ['success' => false, 'message' => 'Notification gagal dihapus'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }
}