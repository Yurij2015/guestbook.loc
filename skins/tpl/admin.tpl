<div class="guest_post">
    <form action="" method="post">
        <div class="guest_paginator">
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
        <div class="guest_form">
            <label><input type="checkbox" name="delete[]" value="<?php echo $id; ?>"></label>
            <?php echo $date; ?> / <strong><?php echo $name; ?></strong>
            <div class="guest_mess">
                <?php echo $mess; ?>
            </div>
        </div>
        <?php
        }
    }
    ?>
        <input name="ok" type="submit" value="Удалить запись" onclick="return confirm('Вы уверены?')">
    </form>
    <div class="guest_paginator">
        <?php echo pageMenu($page, $file); ?>
    </div>
</div>
