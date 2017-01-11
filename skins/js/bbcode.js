function tag(text1, text2)
{
    if ((document.selection))
    {
        document.post.text2.focus();
        document.post.document.selection.createRange().text = text1+document.post.document.selection.createRange().text + text2;
    } else if(document.forms['post'].elements['text2'].selectionStart != undefined) {
        var element    = document.forms['post'].elements['text2'];
        var str        = element.value;
        var start      = element.selectionStart;
        var length     = element.selectionEnd - element.selectionStart;
        element.value  = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
    } else document.post.text2.value += text1 + text2;
}
