<!--
メインのPHPファイルか、フッターのファイルに下記の１行を挿入します。
require 'dump.php';
これにより、下記のデバッグ用関数を利用できます。
例：
d("hoge");
e("hoge");
p("hoge");
rs();
-->

<?php
// var_dump
function d($str) {
    global ${$str};
    echo "<pre style='border:solid;'><b>$$str</b><hr>", var_dump(${$str}), '</pre>';
}

// var_export
function e($str) {
    global ${$str};
    echo "<pre style='border:solid;'><b>$$str</b><hr>", var_export(${$str}), '</pre>';
}

// print_r
function p($str) {
    global ${$str};
    echo "<pre style='border:solid;'><b>$$str</b><hr>", print_r(${$str}, TRUE), '</pre>';
}

// $_REQUESTと$_SESSION
function rs() {
    $arr = ['_REQUEST', '_SESSION'];
    foreach ($arr as $str) {
        global ${$str};
        echo "<pre style='border:solid;'><b>$$str</b><hr>", var_export(${$str}, TRUE), '</pre>';
    }
}
?>

<!-- 以下コピペ用（関数ではない） 

$s=  '_SESSION'  ;echo "<pre style='border:solid;'><b>$$s</b><hr>",var_export(${$s}),'</pre>';

$s=  '_REQUEST'  ;echo "<pre style='border:solid;'><b>$$s</b><hr>",var_export(${$s}),'</pre>';

-->