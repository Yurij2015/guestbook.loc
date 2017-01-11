<?php
//variables
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$text1 = !empty($_POST['text1']) ? $_POST['text1'] : null;
$text2 = !empty($_POST['text2']) ? $_POST['text2'] : null;
$delete = !empty($_POST['delete']) ? $_POST['delete'] : array();
$info = array();
$posts = array();
$file = dirScan('data');