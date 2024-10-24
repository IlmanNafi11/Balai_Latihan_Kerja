<?php
require_once '../App/Config/Database.php';
require_once '../App/Models/NotificationModel.php';

class NotificationController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new NotificationModel($db);
    }

    public function index()
    {
        $notifications = $this->model->getAllNotification();
        require_once "../App/Views/Notifications/notifications.php";
    }

    public function viewAddNotification()
    {
        require_once "../App/Views/Notifications/addNotifications.php";
    }

    public function getAllNotifications()
    {
        $notifications = $this->model->getAllNotification();
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
            if (!empty($message)) {
                $result = $this->model->createNotification($message);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            }
        }
    }

    public function deleteNotification($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $result = $this->model->deleteNotification($id);
            echo json_encode($result);
        }
    }
}