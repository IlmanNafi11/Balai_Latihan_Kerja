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
                http_response_code(200);
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
                http_response_code(404);
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
        $query = "INSERT INTO notifications (pesan, target) VALUES(:message, :target)";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':message', $message);
            $stmt->bindValue(':target', 'Publik');
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

    public function getUpdateNotification($lastCeck)
    {
        $query = "SELECT id AS id, pesan AS pesan, target AS target, created_at AS created_at FROM notifications WHERE created_at > :lastCheck";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':lastCheck', $lastCeck);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return ['success' => true, 'isEmpty' => true, 'message' => 'Data Kosong', 'notifications' => []];
            } else {
                $data[0]['is_read'] = 0;
                return ['success' => true, 'isEmpty' => false, 'notifications' => $data];
            }

        } catch (PDOException $e) {
            http_response_code(500);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getNotificationByUserId($id)
    {
        $query = "SELECT n.id AS notification_id, n.pesan, n.created_at AS notification_created_at, un.id AS id, un.is_read, un.is_deleted FROM notifications n INNER JOIN user_notifications un ON n.id = un.notification_id WHERE un.user_id = :user_id AND un.is_deleted = 0 ORDER BY n.created_at DESC";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':user_id', $id);
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

    public function updateIsRead($id, $userId)
    {
        $query = "UPDATE user_notifications SET is_read = 1 WHERE notification_id = :id AND user_id = :user_id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Notifikasi berhasil diperbarui'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateIsDeleted($id, $userId)
    {
        $query = "UPDATE user_notifications SET is_deleted = 1 WHERE notification_id = :id AND user_id = :user_id";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            http_response_code(200);
            return ['success' => true, 'message' => 'Notifikasi berhasil dihapus'];
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteExpiredNotifications($startDate, $endDate)
    {
        $query = "DELETE FROM notifications WHERE created_at BETWEEN :start_date AND :end_date";
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->bindParam(':start_date', $startDate);
            $stmt->bindParam(':end_date', $endDate);
            $stmt->execute();
            http_response_code(204);
        } catch (PDOException $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Terjadi Kesalahan: ' . $e->getMessage()];
        }
    }
}