<?php
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
        require_once "../App/Views/Notifications/notifications.php";
    }

    public function viewAddNotification()
    {
        require_once "../App/Views/Notifications/addNotifications.php";
    }

    public function getAllNotifications()
    {
        echo json_encode($this->model->getAllNotification());
    }

    public function getNotificationById($id)
    {
        echo json_encode($this->model->getNotificationById($id));
    }

    public function createNotification()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = $data['message'];
        if (!empty($message)) {
            $result = $this->model->createNotification($message);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Kosong']);
        }
    }

    public function deleteNotification($id)
    {
        echo json_encode($this->model->deleteNotification($id));
    }

    public function searchNotifications()
    {
        $name = $_GET['search'] ?? '';
        echo json_encode($this->model->searchNotifications($name));
    }

    public function updateIsRead()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['notificationId'];
        $userId = $data['userId'];
        echo json_encode($this->model->updateIsRead($id, $userId));
    }

    public function updateIsDeleted()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['notificationId'];
        $userId = $data['userId'];
        echo json_encode($this->model->updateIsDeleted($id, $userId));
    }

    public function getNotificationByUserId($id)
    {
        echo json_encode($this->model->getNotificationByUserId($id));
    }
}