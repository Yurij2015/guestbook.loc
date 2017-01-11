<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);

ob_start();

include './config.php';
include './libs/security.php';
include './libs/libs.php';
include './variables.php';
include './modules/admin_controller.php';
include './skins/tpl/admin.tpl';

$content = ob_get_clean();

include './skins/tpl/index.tpl';