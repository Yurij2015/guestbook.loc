<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);

$admins = array(
    'root' => 'root',
    'admin' => '12345',
);

if (empty($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm = "Admin Page"');
    header('HTTP/1.0 401 Unauthorized');
    exit();
}
$key = false;
if (isset($admins[$_SERVER['PHP_AUTH_USER']]) && $_SERVER['PHP_AUTH_PW'] == $admins[$_SERVER['PHP_AUTH_USER']]) {
    $key = true;
}
if (empty($key)) {
    header('WWW-Authenticate: Basic realm = "Admin Page"');
    header('HTTP/1.0 401 Unauthorized');
}







