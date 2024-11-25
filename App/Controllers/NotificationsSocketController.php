<?php

namespace App\Controllers;
require_once '../Models/NotificationModel.php';

use Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../../');
$dotenv->load();

require_once '../Middleware/AuthMiddleware.php';
require_once '../Config/Database.php';

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use NotificationModel;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class NotificationsSocketController implements MessageComponentInterface
{
    protected $clients;
    protected $model;
    protected $lastCheck;

    public function __construct()
    {
        $this->clients = [];

        $database = new Database();
        $db = $database->getConnection();
        $this->model = new NotificationModel($db);
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients[$conn->resourceId] = $conn;
        echo "New connection opened: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        try {
            $data = json_decode($msg, true);
            $secretKey = $_ENV['JWT_SECRET'];
            if (isset($data['token'])) {
                try {
                    JWT::decode($data['token'], new Key($secretKey, 'HS256'));
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => "Token tidak valid atau kadaluarsa"]);
                    return;
                }

                if (isset($data['action']) && $data['action'] === 'fetch' && isset($data['userId'])) {
                    $userId = $data['userId'];
                    $notifications = $this->model->getNotificationByUserId($userId);

                    if (!$notifications['isEmpty']) {
                        $from->send(json_encode($notifications));
                    } else {
                        $from->send(json_encode(['success' => false, 'message' => 'Notification tidak ditemukan']));
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Token Tidak ditemukan.']);
                return;
            }
        } catch (\Exception $e) {
            $from->send(json_encode(['success' => false, 'message' => 'Error processing request.']));
            echo "Error processing message: " . $e->getMessage() . "\n";
        }

    }

    function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
        echo "Connection closed: {$conn->resourceId}\n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: " . $e->getMessage() . "\n";
        $conn->close();
    }

    public function scheduleNotificationCheck($loop)
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->lastCheck = date('Y-m-d H:i:s');
        $loop->addPeriodicTimer(2, function () {
            $newNotif = $this->model->getUpdateNotification($this->lastCheck);
            if ($newNotif['success'] && !$newNotif['isEmpty']) {
                $this->lastCheck = date('Y-m-d H:i:s');
                foreach ($this->clients as $client) {
                    $client->send(json_encode($newNotif));
                }
            }
        });

        $loop->run();
    }
}