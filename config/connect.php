<?php
use Dotenv\Dotenv;
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

$connect = new mysqli($host, $username, $password, $database);
if($connect->connect_errno)
{
    die('DB connection error: '.$connect->connect_error);
}