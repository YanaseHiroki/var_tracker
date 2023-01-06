<pre>
<?php
require 'function.php';
$contents = ['<?php $a=1;$b=2;', '$c=3;', 'echo 123;'];
$path = '.';
$main_file = 'てすと';

// 配列$contentsのセミコロンがそれぞれ何行目にあるか取得
$semicolon_place = semicolon_place($contents);

// 配列$contentsの行末セミコロンの時点での変数を取得
$vars_semicolon = semicolon_vars($contents, $path, $main_file);

// 各行での最終的な変数を決定、配列$vars_in_the_wayに格納
$vars_in_the_way = vars_in_the_way($contents, $semicolon_place, $vars_semicolon);


echo "var_exportです<hr>";
var_export($semicolon_place);


?></pre>