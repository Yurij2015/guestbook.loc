<?php
if (empty($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm = "Admin Page"');
    header('HTTP/1.0 401 Unauthorized');
    exit();
}
if (isset($_SERVER['PHP_AUTH_USER']) == $admins['root'] && $_SERVER['PHP_AUTH_PW'] == $admins['admin']) {
    $key = true;
}
if (empty($key)) {
    header('WWW-Authenticate: Basic realm = "Admin Page"');
    header('HTTP/1.0 401 Unauthorized');
    exit();
}