<?php
session_start();

$logged_in = $_SESSION['logged_in'] ?? false;

function require_login($logged_in): void
{
    if ($logged_in === false) {
        header("Location: public/php/login.php");
        exit;
    }
}

function login($email)
{
    session_regenerate_id(true);
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;
}
function logout()
{
    session_unset();
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    session_destroy();
}