<?php
require './func/element.php';
require './func/dump.php';
require './func/check.php';
require './func/process.php';
require './module/header.php';

// ファイルの保存先
$path = './uploaded/userfile.php';

// ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
if( !empty($_FILES['userfile']['tmp_name']) && is_uploaded_file($_FILES['userfile']['tmp_name']) ) {

	// ファイルを指定したパスへ保存する
	if( move_uploaded_file( $_FILES['userfile']['tmp_name'], $path) ) {
		echo 'アップロードされたファイルを保存しました。';
	} else {
		echo 'アップロードされたファイルの保存に失敗しました。';
	}
}

// 保存したファイルの読み込み
$contents = file($path, FILE_IGNORE_NEW_LINES);

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

// 内容確認
// $h_inserted = h($inserted);
// p('h_inserted');

// 配列$insertedを結合してファイル保存
$inserted_str = implode("\n", $inserted);
file_put_contents('./uploaded/inserted.php', $inserted_str);

// ファイルinserted.phpを呼び出して裏で実行
echo '<div hidden>ここは表示されない';
require './uploaded/inserted.php';
echo '</div>';
e('vars_in_the_way');
echo '<pre>';
$i = 1;

$max = strlen(count($contents));
foreach ($contents as $line) {

    // 行数
    $i_pad = str_pad($i, $max, " ", STR_PAD_LEFT);
    echo "│";
    var_export("<a href=track.php?line=$i>$i_pad</a>");
    echo "│\t";
    
    // 変数列

    // コード内容
    $line = htmlentities($line);
    echo $line, "\n";
    if ($_REQUEST['line'] == $i) {
        $vars = $vars_in_the_way[$i-1];
        echo "</pre><pre>", var_export($vars), "</pre><pre>";
    }
    $i++;

}
echo '</pre>';
require './module/footer.php';
?>
