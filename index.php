<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);
//adjustment. posts on page

define('NUM_POSTS', 5);

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
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$text1 = !empty($_POST['text1']) ? $_POST['text1'] : null;
$text2 = !empty($_POST['text2']) ? $_POST['text2'] : null;
$info = array();
$posts = array();
$file = dirScan('data');
?>
<?php
if (!empty($_POST['ok'])) {
    if (!$text1) {
        $info[] = 'Текстовое поле не заполнено';
    }
    if (!$text2) {
        $info[] = 'Текстовая область не заполнена';
    }
    if (count($info) == 0) {
        if (file_exists('data/' . $file)) {
            $posts = unserialize(file_get_contents('data/' . $file));
            $keys = array_keys($posts);
            $id = max($keys) + 1;
            $cnt = count($posts);
        } else
            $cnt = $id = 1;
        if ($cnt >= 5) {
            ++$file;
            unset($posts);
        }
        $posts[$id]['date'] = date('d-m-Y');
        $posts[$id]['name'] = $text1;
        $posts[$id]['mess'] = $text2;
        file_put_contents('data/' . $file, serialize($posts));
        header('location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] .'?page='. $file);
        exit();
    }
} else {
    $info[] = 'Напишите что-нибудь';
}
?>
    <form action="" method="post">
        <label><input name="text1" type="text" value="<?php echo htmlspecialchars($text1); ?>"></label><br>
        <label><textarea name="text2" cols="40" rows="10"><?php echo htmlspecialchars($text2); ?></textarea></label>
        <label><input name="ok" type="submit"></label>
    </form>
<div style="padding-left: 50px;">
<?php echo pageMenu($page, $file);
?>
</div>
<?php
echo implode('<br>', $info) . '<br>';
if (file_exists('data/'. $page)) {
    $array = unserialize(file_get_contents('data/'. $page));
    foreach ($array as $id => $post) {
        $date = $post['date'];
        $name = htmlspecialchars($post['name']);
        $mess = nl2br(bb_tags(htmlspecialchars($post['mess'])));
        ?>
        <div style="border: 1px solid; width: 70%; background-color: #66FFFF; min-height: 100px; margin: 5px; padding: 5px">
            <?php echo $date; ?> / <strong><?php echo $name; ?></strong>
            <hr width="30%" align="left">
            <?php echo $mess; ?>
        </div>
        <?php
    }
}
?>
<div style="padding-left: 50px;">
    <?php echo pageMenu($page, $file); ?>
</div>
