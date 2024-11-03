<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require_once '../App/Config/Database.php';
require_once '../App/Routers/web.php';