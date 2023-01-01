<?php
require './func/element.php';
require './func/dump.php';
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

// ブレイクボタン


echo '<pre>';
$i = 1;
foreach ($contents as $line) {

    // ブレイクボタン
    $i_pad = str_pad($i, 5, " ", STR_PAD_LEFT);
    var_export("<a href=track.php?line=$i>$i_pad</a>");
    echo "│　";
    
    // 変数列

    // コード内容
    $line = htmlentities($line);
    echo $line, "\n";
    $i++;
}
echo '</pre>';
require './module/footer.php';
?>
