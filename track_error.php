<?php
session_start();
require './module/function.php';
require './module/header.php';

// エラー表示設定をTRUEにする
// ini_set( 'display_errors' , 1 );

// メインファイル名の取得
$main_file = $_SESSION['main_file'];

// コードのPHP部分の表示（メイン部分）
$main_file_name = basename($main_file);
echo "<h3>$main_file_name</h3>";

// track_ok.phpからメインファイル名が渡されているか検査
if (!isset($_SESSION['main_file'])) {
    echo '<p class="text-danger">表示するファイルがありません。</p>';
    echo '<a href="file-input.php">ファイル追加に戻る</a>';
    remove_directory($main_file_dir);
    exit;
}

// メインファイルの内容を読み込み
$contents = file($main_file, FILE_IGNORE_NEW_LINES);

// ーー↑ファイル受け取り処理ここまでーー
// ーー↓変数取得準備ここから（セミコロンの場所で変数を取得してまとめるバージョン）ーー

// $contentsの各要素をtrimする
foreach($contents as &$line) {
    $line = rtrim($line);
}

// PHPの中の行末セミコロンの直後にスクリプトを埋め込む
// $inserted = semicolon_insert($contents);
$inserted[] = '<?php $vars_initial = get_defined_vars(); ?>';
$inserted[] = '<?php $line = $_REQUEST["line"]; ?>';
$i=0;                                       // $i: $contentsの行番号


foreach ($contents as $line) {  
    if(';' === substr($line, -1)) {
        $line_replace = str_replace("'", "’", $line);
        $inserted[] = 'if($line != ' . "$i) {";
        $inserted[] =   "echo '<a href=\"track_error.php?line=$i\"><u>
                        <code class=\"language-php\">$line_replace</code>
                        </u></a><br>';";
        $inserted[] = '} else {';
        $inserted[] =   "echo '<a href=\"track_error.php\"><u>
                        <code class=\"language-php\">$line_replace</code>
                        </u></a><br>';}";
            $inserted[] = $line;
        $inserted[] = 'if($line == ' . "$i) {";
        $inserted[] = '$vars = array_diff(get_defined_vars(),$vars_initial);';
        $inserted[] = 'error_put_table($vars);}';
    } else {
        $inserted[] = $line;
    }
    $i++;
}

// ーー↑変数取得準備ここまで（セミコロンの場所で変数を取得してまとめるバージョン）ーー
// ーー↓コード実行ここからーー

// 配列$contentsの行末セミコロンの時点での変数を取得
$vars_in_the_way = semicolon_vars($inserted, $main_file, 'open');

echo '<hr><a href="track_ok.php" class="btn btn-default">最後まで処理が流れる場合の分析ツールに戻る</a>';
require './module/footer.php';
?>
