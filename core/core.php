<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

date_default_timezone_set('Africa/Accra');

require_once __DIR__ . '/db_class.php';

function get_ip()
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function is_logged_in()
{
    return isset($_SESSION['customer_id']);
}

function is_admin()
{
    return isset($_SESSION['user_role']) && (int) $_SESSION['user_role'] === 1;
}

function require_login()
{
    if (!is_logged_in()) {
        redirect("../views/login.php");
    }
}

function require_admin()
{
    if (!is_admin()) {
        $_SESSION['error'] = 'Access denied. Admins only!';
        redirect("../index.php");
    }
}
?>