<?php

require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Models/ProgramModel.php';
require_once '/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/App/Config/Database.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('/home/u137138991/domains/pelatihanku.pbltifnganjuk.com/public_html/');
$dotenv->load();

class StatusPendaftaranHandler
{

    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new ProgramModel($db);
    }

    public function updateStatusPendaftaran()
    {
        echo json_encode($this->model->updateStatusPendaftaran());
    }
}

$statusPendaftaranHandler = new StatusPendaftaranHandler();
$statusPendaftaranHandler->updateStatusPendaftaran();