<div class="guest_paginator">
    <?php echo pageMenu($page, $file); ?>
</div>
<?php
if (file_exists('data/'. $page)) {
$posts = unserialize(file_get_contents('data/'. $page));
foreach ($posts as $id => $post) {
$date = $post['date'];
$name = htmlspecialchars($post['name']);
$mess = nl2br(bb_tags(htmlspecialchars($post['mess'])));
?>
<div class="guest_post">
    <div class="guest_mess">
        <?php echo $date; ?> / <strong><?php echo $name; ?></strong>
        <?php echo $mess; ?>
    </div
            <?php
        }
    }
?>
</div>
<div class="guest_info">
    <?php echo implode('<br>', $info); ?>
</div>
<div class="guest_form">
    <form action="" method="post">
        <label>Имя:<br><input name="text1" type="text" value="<?php echo htmlspecialchars($text1); ?>">
        </label><br>
        <label>Сообщение:<br><textarea name="text2" cols="40"
                                       rows="10"><?php echo htmlspecialchars($text2); ?></textarea></label>
        <label><br><input name="ok" type="submit" value="Отправить"></label>
    </form>
</div>
<div class="guest_paginator">
    <?php echo pageMenu($page, $file);?>
</div>

