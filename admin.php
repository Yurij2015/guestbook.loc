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
if (isset($_SERVER['PHP_AUTH_USER']) == $admins['root'] && $_SERVER['PHP_AUTH_PW'] == $admins['admin']) {
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

//variables
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$delete = !empty($_POST['delete']) ? $_POST['delete'] : array();
$posts = array();
$file = dirScan('data');
?>
<?php
//script

if (!empty($_POST['ok'])) {
    if (count($delete) > 0) {
        $posts = unserialize(file_get_contents('data/'. $page));
        for ($i = 0; $i < count($delete); ++$i) {
            $posts[$delete[$i]] ['name'] = '';
            $posts[$delete[$i]] ['mess'] = 'Удалено модератором';
        }
        file_put_contents('data/'. $page, serialize($posts));
        header('location: http://'. $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?page=' . $page);
        exit();
    }
}

//view
?>
<form action="" method="post">
    <div style="padding-left: 50px">
        <?php echo pageMenu($page, $file); ?>
    </div>
    <?php
    if (file_exists('data/' . $page)) {
        $posts = unserialize(file_get_contents('data/' . $page));
        foreach ($posts as $id => $post) {
            $date = $post['date'];
            $name = htmlspecialchars($post['name']);
            $mess = nl2br(bb_tags(htmlspecialchars($post['mess'])));
            ?>
            <div style="border: 1px solid; width: 70%; background: #66FFFF; min-height: 100px; margin: 5px; padding: 5px;">
                <label><input type="checkbox" name="delete[]" value="<?php echo $id; ?>"></label>
                <?php echo $date; ?> / <strong><?php echo $name; ?></strong>
                <hr width="30%" align="left">
                <?php echo $mess; ?>
            </div>
            <?php
        }
    }
    ?>
    <div style="padding-left: 50px">
        <?php echo pageMenu($page, $file); ?>
    </div>
    <input name="ok" type="submit" value="Удалить запись" onclick="return confirm('Вы уверены?')">
</form>