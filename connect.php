<?php
$host='localhost';
$username='root';
$password='';
$db='note_taking_app';
$dbprefix='';

$mysqli = new mysqli($host, $username, $password, $db);
if($mysqli->connect_errno) {
    die('DB connection error: '.$mysqli->connect_error);
}
?>
