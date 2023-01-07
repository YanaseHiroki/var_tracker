<?php
session_start();
require './module/function.php';
require './module/header.php';

// エラー表示設定をTRUEにする
ini_set( 'display_errors' , 1 );


// ダウンロードフォルダを作成
$path = isset($_SESSION['path']) ? $_SESSION['path'] : 'download/'. date('ymd-His');
$_SESSION['path'] = $path;
if (!file_exists('download')) mkdir('download');
if (!file_exists($path)) mkdir($path);

// メインファイル名の取得とセッションへの保存
$main_file = isset($_REQUEST['main_file']) ? $_REQUEST['main_file'] : $_SESSION['main_file'];
$_SESSION['main_file'] = $main_file;

// ファイルがあればファイル受け取り処理実行
if(isset($_FILES["upload_file"])){

    // アップロードされたファイルの数だけ処理
    for($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++ ){

        // アップロードされたファイルか検査
        if(is_uploaded_file($_FILES["upload_file"]["tmp_name"][$i])){

            // そのファイルがメインファイルか照合
            if($main_file === $_FILES["upload_file"]["name"][$i]) {
                
                // 一時ファイルを変数とセッションに読み込み
                $contents = file($_FILES['upload_file']['tmp_name'][$i], FILE_IGNORE_NEW_LINES);
                $_SESSION['contents'] = $contents;
            } else {

                // ファイルをダウンロードフォルダに移動
                move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], $path . "/" . $_FILES["upload_file"]["name"][$i]);
            }

        }
    }
} else {
    // ファイルが渡されているか検査
    if (!isset($_SESSION['main_file'])) {
        echo '<p class="text-danger">表示するファイルがありません。</p>';
        echo '<a href="file-input.php">ファイル追加に戻る</a>';
        remove_directory('download');
        exit;
    }

    // セッションからメインファイルの内容を読み込み
    $contents = $_SESSION['contents'];
}
// ーー↑ファイル受け取り処理ここまでーー
// ーー↓変数取得処理ここから（セミコロンの場所で変数を取得してまとめるバージョン）ーー

// $contentsの各要素をtrimする
foreach($contents as &$line) {
    $line = rtrim($line);
}

// 配列$contentsのセミコロンがそれぞれ何行目にあるか取得
$semicolon_place = semicolon_place($contents);

// 配列$contentsの行末セミコロンの時点での変数を取得
$semicolon_vars = semicolon_vars($contents, $path, $main_file);

// 各行での最終的な変数を決定、配列$vars_in_the_wayに格納
$vars_in_the_way = vars_in_the_way($semicolon_place, $semicolon_vars);

// コードのPHP部分の表示（メイン部分）
echo "<h3>$main_file</h3><pre>";

$i = 1;
$max = strlen(count($contents));
// ーー↑変数取得処理ここまで（セミコロンの場所で変数を取得してまとめるバージョン）ーー
// ーー↓コード出力ここからーー

// 列名の出力
$reset_link = '<a href="track.php"><button>' . '$' . $_REQUEST['var'] . '</button></a>';
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
foreach ($contents as $line) {

    // 1列目：行番号（ブレイクリンク）
    $href = ($_REQUEST['line'] == $i) ? '' : $i;
    print("<tr><td class='first_column'><a href=track.php?line=$href><button>$i</button></a></td>\n");
    
    // ２列目：変数の値
    echo "<td class='second_column dump'>";
    if (isset($_REQUEST['var'])) {
        $key = $_REQUEST['var'];
        if (isset($vars_in_the_way[$i-1][$key])) {
            var_dump($vars_in_the_way[$i-1][$key]);
        } else {
            echo "<font color='green'>undefined</font>\n";
        }
    }
    echo "</td>\n";

    // ３列目：PHPコード
    echo "<td><code class='language-php'>$line</code></td></tr>\n";

    // 行番号が選択されている場合
    if ($_REQUEST['line'] == $i) {

        // 変数の値を表形式で出力
        $vars = $vars_in_the_way[$i-1];
        echo "</table></pre><pre class='variables'><table><tr class='name'><th>変数</th><th>値</th></tr class='dump'>\n";
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

require './module/footer.php';
?>
