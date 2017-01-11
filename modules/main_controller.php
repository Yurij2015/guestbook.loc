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
        header('location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?page=' . $file);
        exit();
    }
} else {
    $info[] = 'Оставьте свое сообщение:';
}