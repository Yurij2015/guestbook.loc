<?php
if (!empty($_POST['ok'])) {
    if (count($delete) > 0) {
        $posts = unserialize(file_get_contents('data/'. $page));
        for ($i = 0; $i < count($delete); ++$i) {
            $posts[$delete[$i]] ['name'] = '';
            $posts[$delete[$i]] ['mess'] = 'Запись удалена модератором по причине нарушения правил сайта!';
        }
        file_put_contents('data/'. $page, serialize($posts));
        header('location: http://'. $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?page=' . $page);
        exit();
    }
}