<?php
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/vendor/autoload.php';
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Models/NotificationModel.php';
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Config/Database.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/');
$dotenv->load();

use Google\Client;
use GuzzleHttp\Client as Guzzle;

const PROJECT_ID = 'balai-latihan';
const FIREBASE_SERVICE_ACCOUNT = __DIR__ . '/../Config/balai-latihan-firebase-adminsdk-lrsix-3bbd66d9ad.json';
const FIREBASE_URL = 'https://fcm.googleapis.com/v1/projects/balai-latihan/messages:send';
class FcmController
{
    private $notificationModel;

    function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->notificationModel = new NotificationModel($db);
    }

    function getAccessToken()
    {
        $client = new Client();
        $client->setAuthConfig(FIREBASE_SERVICE_ACCOUNT);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $accessToken = $client->fetchAccessTokenWithAssertion();

        if (isset($accessToken['error'])) {
            throw new Exception("Error fetching access token: " . $accessToken['error']);
        }

        return $accessToken['access_token'];
    }

    function sendNotification($title, $message, $topic, $data = [])
    {
        $accesToken = $this->getAccessToken();
        $httpClient = new Guzzle();

        $payload = [
            "message" => [
                "topic" => $topic,
                "notification" => [
                    'title' => $title,
                    'body' => $message
                ],
                "data" => [
                    "id" => (string)$data['id'],
                    "is_read" => (string)$data['is_read'],
                ]
            ]
        ];

        $response = $httpClient->request('POST', FIREBASE_URL, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accesToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Fungsi untuk melakukan pengecekan data notification secara berkala menggunakan cron job
     * @return void
     */
    function checkerData()
    {
        date_default_timezone_set('Asia/Jakarta');
        $lastCheck = date('Y-m-d H:i:s', strtotime('-1 minute'));
        $topic = "all_users";
        $result = $this->notificationModel->getUpdateNotification($lastCheck);
        if (!$result['isEmpty']) {
            foreach ($result['notifications'] as $notification) {
                $data = [
                    "id" => $notification['id'],
                    "is_read" => $notification['is_read']
                ];
                json_encode($this->sendNotification(
                    "Notifikasi Baru!",
                    $notification['pesan'],
                    $topic,
                    $data
                ));
            }
        }
    }
}

$fcp = new FcmController();
$fcp->checkerData();

