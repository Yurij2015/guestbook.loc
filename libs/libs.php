<?php
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
        '<img src="../smiles/1.gif">',
        '<img src="../smiles/2.gif">',
        '<img src="../smiles/3.gif">',
        '<img src="../smiles/4.gif">'
    );
    return str_ireplace($bb, $tag, $text);
}
//end functions for bb-tags