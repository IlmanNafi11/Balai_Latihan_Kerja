<?php

require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/vendor/autoload.php';
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Models/NotificationModel.php';
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Config/Database.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/');
$dotenv->load();
class ExpiredNotificationHandler
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new NotificationModel($db);
    }

    public function deleteExpiredNotification()
    {
        $startDate = date('Y-m-01', strtotime('first day of last month'));
        $endDate = date('Y-m-t', strtotime('last day of last month'));
        echo json_encode($this->model->deleteExpiredNotifications($startDate, $endDate));
    }
}

$expiredNotificationHandler = new ExpiredNotificationHandler();
$expiredNotificationHandler->deleteExpiredNotification();