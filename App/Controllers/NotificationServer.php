<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server as ReactSocket;
use App\Controllers\NotificationsSocketController;

require_once '../../vendor/autoload.php';

$loop = Factory::create();
$controller = new NotificationsSocketController();
$socket = new ReactSocket('192.168.100.4:8000', $loop);
$server = new IoServer(
    new HttpServer(
        new WsServer($controller)
    ),
    $socket,
    $loop
);
$controller->scheduleNotificationCheck($loop);
$loop->run();