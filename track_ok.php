<?php
session_start();
require './module/function.php';
require './module/header.php';

// エラー表示設定をTRUEにする
// ini_set( 'display_errors' , 1 );

// メインファイル名の取得とセッションへの保存
$main_file = isset($_REQUEST['main_file']) ? $_REQUEST['main_file'] : $_SESSION['main_file'];
$_SESSION['main_file'] = $main_file;
$_SESSION['main_file_dir'] = dirname($main_file);

// インプットページからメインファイル名が渡されているか検査
if (!isset($_SESSION['main_file'])) {
    echo '<p class="text-danger">表示するファイルがありません。</p>';
    echo '<a href="file-input.php">ファイル追加に戻る</a>';
    remove_directory($main_file_dir);
    exit;
}

// メインファイルの内容を読み込み
$contents = file($main_file, FILE_IGNORE_NEW_LINES);

// ーー↑ファイル受け取り処理ここまでーー
// ーー↓変数取得処理ここから（セミコロンの場所で変数を取得してまとめるバージョン）ーー

// $contentsの各要素をtrimする
foreach($contents as &$line) {
    $line = rtrim($line);
}

// PHPの中の行末セミコロンの直後にスクリプトを埋め込む
$inserted = semicolon_insert($contents);

// 配列$contentsの行末セミコロンの時点での変数を取得
echo '<a href="track_error.php">エラーで最後まで処理が流れない場合の分析ツール</a>';
$vars_in_the_way = semicolon_vars($inserted, $main_file);

// ーー↑変数取得処理ここまで（セミコロンの場所で変数を取得してまとめるバージョン）ーー
// ーー↓コード出力ここからーー

// コードのPHP部分の表示（メイン部分）
$main_file = basename($main_file);
echo "<h3>$main_file</h3><pre>";

$i = 1;
$max = strlen(count($contents));
// 列名の出力
$reset_link = '<a href="track_ok.php"><button>' . '$' . $_REQUEST['var'] . '</button></a>';
$name_tracking = (isset($_REQUEST['var'])) ? $reset_link : '変数';
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

// タグなどの記号を文字に置き換える
$contents = h($contents);

// メインファイルの各行を出力
foreach ($contents as $line) {

    // 1列目：行番号（ブレイクリンク）
    $num = ($_REQUEST['line'] == $i) ? '' : $i;
    print("<tr><td class='first_column'><a href=track_ok.php?line=$num><button>$i</button></a></td>\n");
    
    // ２列目：変数の値
    echo "<td class='second_column'>";

    // 変数のボタンをクリックして選択されているか検査
    if (isset($_REQUEST['var'])) {
        $key = $_REQUEST['var'];

        // その行の変数が保存されているか検査
        if (isset($vars_in_the_way[$i-1])) {

            // 指定された変数の値が保存されているか検査
            if (isset($vars_in_the_way[$i-1][$key])) {
            var_dump($vars_in_the_way[$i-1][$key]);
            } else {
                echo "<span class='undefined'>undefined</span>\n";
            }
        }
    }
    echo "</td>\n";

    // ３列目：PHPコード
    echo "<td><code class='language-php'>$line</code></td></tr>\n";

    // 行番号が選択されている場合
    if ($_REQUEST['line'] == $i) {

        // 変数の値を表形式で出力
        $vars = $vars_in_the_way[$i-1];
        echo "</table></pre><pre class='variables'><table><tr class='name'><th>変数</th><th>値</th></tr>\n";
        foreach ($vars as $name => $value) {
            echo "<tr><td><a href='./track_ok.php?var=$name'><button>$$name</button></a></td><td>\n";
            var_dump($value);
            echo "</td></tr>\n";
        }        
        echo "</table></pre><pre><table class='main'>\n";
    }
    $i++;

}
echo "</table></pre>\n";
require './module/footer.php';
?>
