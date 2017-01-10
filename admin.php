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
    exit();
}

//function pagemenu
function pageMenu($page, $file)
{
    $menu = ' | ';
    for ($i = 1; $i <= $file; ++$i)
        if ($page == $i) {
            $menu .= '<strong>' . $i . '</strong> | ';
        } else {
            $menu .= '<a href="?page=' . $i . '">' . $i . '</a> | ';
        }
    return $menu;
}

//function of reading of a directory
function dirScan($dir = 'data')
{
    $files = scandir($dir);
    $files = array_diff($files, array('.', '..'));
    return !empty($files) ? max($files) : 1;
}

//end function of reading of a directory
//-------------------------------------
//functions for bb-tags
function bb_tags($text)
{
    $bb = array(
        '[B]',
        '[/B]',
        '[I]',
        '[/I]',
        '[S]',
        '[/S]',
        '[U]',
        '[/U]',
        '[:)]',
        '[:(]',
        '[;)]',
        '[:D]'
    );
    $tag = array(
        '<b>',
        '</b>',
        '<i>',
        '</i>',
        '<s>',
        '</s>',
        '<u>',
        '</u>',
        '<img src="smiles/1.gif">',
        '<img src="smiles/3.gif">',
        '<img src="smiles/3.gif">',
        '<img src="smiles/4.gif">'
    );
    return str_ireplace($bb, $tag, $text);
}
//end functions for bb-tags

//variables
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$delete = !empty($_POST['delete']) ? $_POST['delete'] : array();
$posts = array();
$file = dirScan('data');
?>

//script
<?php

echo !empty($delete) ? "<b>Выбранны посты с id:</b></b><br>". implode('<br>', $delete) : '';

?>

//view
<form action="" method="post">


</form>








