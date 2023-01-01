<?php
require './func/element.php';
require './func/dump.php';
require './func/check.php';
require './module/header.php';

$vars_initial = get_defined_vars();

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

// タグの置換
// $contents = h($contents);


// 各行にget_defined_vars()を埋め込む
foreach ($contents as $line) {
    $inserted[] = $line;
    $inserted[] = '<?php $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); ?>';
}
array_unshift($inserted, '<?php $vars_initial = get_defined_vars(); ?>');

var_export($inserted);
// $inserted = h($inserted);
// p('inserted');

// 配列$insertedを結合してファイル保存
$inserted_str = implode("\n", $inserted);
file_put_contents('./uploaded/inserted.php', $inserted_str);

// ファイルinserted.phpを呼び出して裏で実行

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
    $vars = array_diff(get_defined_vars(),$vars_initial);
    echo "</pre><pre>", var_export($vars), "</pre><pre>";
    }
    $i++;

}
echo '</pre>';
require './module/footer.php';
?>
