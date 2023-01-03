<?php
session_start();
require './module/function.php';
require './module/header.php';

var_export($_FILES);
$main_file = $_REQUEST['main_file'];
exit;
// ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
if( !empty($_FILES['userfile']['tmp_name']) && is_uploaded_file($_FILES['userfile']['tmp_name']) ) {

    // 一時ファイルの読み込み
    $contents = file($_FILES['userfile']['tmp_name'], FILE_IGNORE_NEW_LINES);
    $_SESSION['contents'] = $contents;
} else {

    // セッションからファイルの内容を読み込み
    $contents = $_SESSION['contents'];
}


// 読み込んだコードからhtmlを削除
$contents_str = implode("NeXtLiNe", $contents);
preg_match_all('/\?php.+?\?>/', $contents_str, $contents_arr);
$contents_arr = $contents_arr[0];
for($i=0; $i<count($contents_arr); $i++) {
    $contents_arr[$i] = str_replace('?php', '', $contents_arr[$i]);
    $contents_arr[$i] = str_replace('?>', '', $contents_arr[$i]);
}
$contents_str = implode("NeXtLiNe", $contents_arr);
$contents_arr = explode("NeXtLiNe", $contents_str);
$contents = array_filter($contents_arr);

// $contentsの各行の間にget_defined_vars()関数を埋め込む
$i = 0;
foreach ($contents as $line) {
    $inserted[] = $line;
    $inserted[] = '$vars_in_the_way[' . $i . '] = array_diff(get_defined_vars(),$vars_initial);';
    $i++;
}
array_unshift($inserted, '<?php $vars_initial = get_defined_vars();');

// 配列$insertedを結合してファイル保存
$inserted_str = implode("\n", $inserted);
file_put_contents('inserted.php', $inserted_str);

// ファイルinserted.phpを呼び出して裏で実行
echo '<details><summary>出力内容▼</summary>';
require 'inserted.php';
echo '</details>';

// コードのPHP部分の表示（メイン部分）
echo "<hr><h3>変数の値</h3><pre>";

$i = 1;
$max = strlen(count($contents));

// 列名の出力
$name_tracking = (isset($_REQUEST['var'])) ? '$' . $_REQUEST['var'] : '変数';
echo <<<EOT
<table class='main'>
    <thead>
        <tr class='name'>
            <th class='first_column'>No</th>
            <th>$name_tracking</th>
            <th>PHP</th>
        </tr>
    </thead>
EOT;

foreach ($contents as $line) {

    // 1列目：行番号（ブレイクリンク）
    $href = ($_REQUEST['line'] == $i) ? '' : $i;
    print("<tr><td class='first_column'><a href=track.php?line=$href><button>$i</button></a></td>\n");
    
    // ２列目：変数の値
    echo "<td class='second_column'>";
    if (isset($_REQUEST['var'])) {
        $key = $_REQUEST['var'];
        if (isset($vars_in_the_way[$i-1][$key])) {
            var_dump($vars_in_the_way[$i-1][$key]);
        } else {
            echo "<font color='blue'>undefined</font>\n";
        }
    }
    echo "</td>\n";

    // ３列目：PHPコード
    $line = htmlentities($line);
    echo "<td>$line</td></tr>\n";

    // 行番号が選択されている場合
    if ($_REQUEST['line'] == $i) {

        // 変数の値を表形式で出力
        $vars = $vars_in_the_way[$i-1];
        echo "</table></pre><pre class='variables'><table><tr class='name'><td>変数</td><td>値</td></tr>\n";
        foreach ($vars as $name => $value) {
            echo "<tr><td><a href='./track.php?var=$name'><button>$$name</button></a></td><td>\n";
            var_dump($value);
            echo "</td></tr>\n";
        }        
        echo "</table></pre><pre><table class='main'>\n";
    }
    $i++;

}
echo "</table></pre>\n";

//ファイルを削除する
if(file_exists('inserted.php')) unlink('inserted.php');

require './module/footer.php';
?>
