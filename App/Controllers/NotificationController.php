<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/LoginAuthModel.php';

class NotificationController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

    }

    public function index()
    {
        require_once "../App/Views/Notifications/notifications.php";
    }

    public function viewAddNotification()
    {
        require_once "../App/Views/Notifications/addNotifications.php";
    }

    public function getAllNotifications()
    {
        $notifications = $this->model->getAllNotifications();
        echo json_encode($notifications);
    }

    public function getNotificationById($id)
    {
        $data = $this->model->getNotificationById($id);
        if (empty($data)) {
            echo json_encode($data);
        }
    }

    public function createNotification()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $message = $data['message'];
            $type = $data['type'];
            if (!empty($message) && !empty($type)) {
                $result = $this->model->createNotification($message, $type);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            }
        }
    }

    public function deleteNotificationById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $result = $this->model->deleteNotificationById($id);
            echo json_encode($result);
        }
    }
}