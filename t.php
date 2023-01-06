<pre>
<?php
$contents = ['$a = 1;','$b = 2;','$c = 3;'];
$path = '.';

for ($i=0; $i<count($contents); $i++) {
    $vars_in_the_way[$i] = inspect_line ($contents, $i+2, $path);
}
var_export($vars_in_the_way);

// PHPを受け取り、指定された行で定義されている変数の値を返す
// （引数：PHP（配列）、行番号、ダウンロードフォルダのパス）
function inspect_line ($contents, $i, $path) {
    array_splice($contents, $i, 0, '$vars_line = array_diff(get_defined_vars(),$vars_initial);');

    array_unshift($contents, '<?php $vars_initial = get_defined_vars();');
    // 配列$contentsを文字列に結合してファイルとして保存
    $inserted_str = implode("\n", $contents);
    file_put_contents( $path . '/inserted.php', $inserted_str);


    // 非表示要素の内部でファイルを呼び出して実行
    echo '<div hidden>';
    try {
        include $path . '/inserted.php';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo '</div>';

    return $vars_line ?? '';

}

?></pre>