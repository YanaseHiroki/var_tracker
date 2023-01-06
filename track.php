<?php
session_start();
require './module/function.php';
require './module/header.php';

// エラー表示設定をTRUEにする
ini_set( 'display_errors' , 1 );


// ダウンロードフォルダを作成
$path = isset($_FILES["upload_file"]) ? 'download/'. date('ymdhis') : $_SESSION['path'];
$_SESSION['path'] = $path;
if (!file_exists('download')) mkdir('download');
if (!file_exists($path)) mkdir($path);

// メインファイル名の取得とセッションへの保存
$main_file = isset($_REQUEST['main_file']) ? $_REQUEST['main_file'] : $_SESSION['main_file'];
$_SESSION['main_file'] = $main_file;

// ファイルがあれば処理実行
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

// // コメント行を削除
// foreach ($contents as &$line) {
//     if ($line[0] === '/') {
//         $line = '';
//     }
// }

// // $contentsに読み込んだコードからhtmlを削除
// $contents = trim_html($contents);

// // $contentsの各行の間にget_defined_vars()関数などを埋め込む
// $i = 0;
// foreach ($contents as $line) {
//     $inserted[] = $line;
//     $inserted[] = '$vars_in_the_way[' . $i . '] = array_diff(get_defined_vars(),$vars_initial);';
//     $i++;
// }
// array_unshift($inserted, '<?php $vars_initial = get_defined_vars();');




// // 配列$insertedを文字列に結合してファイルとして保存
// $inserted_str = implode("\n", $inserted);
// file_put_contents( $path . '/inserted.php', $inserted_str);

// 配列$contentsを文字列に結合してファイルとして保存
$contents_str = implode("\n", $contents);
file_put_contents( "$path/$main_file.php", $contents_str);

// エラー表示設定をTRUEにする
ini_set( 'display_errors' , 1 );

// ファイルinserted.phpを呼び出して実行
echo '<details><summary>出力内容▼</summary>';
try {
    include "$path/$main_file.php";
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '</details>';

// エラー表示設定を解除
// ini_set( 'display_errors' , 0 );

// 各行における変数を取得
for ($i=0; $i<count($contents); $i++) {
    if(empty(inspect_line ($contents, $i+1, $path)) && $i != 0){
        $vars_in_the_way[$i] = $vars_in_the_way[$i-1];
    } else {
        $vars_in_the_way[$i] = inspect_line ($contents, $i+1, $path);
    }
    
}
// コードのPHP部分の表示（メイン部分）
echo "<h3>$main_file</h3><pre>";

$i = 1;
$max = strlen(count($contents));

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
            echo "<font color='green'>undefined</font>\n";
        }
    }
    echo "</td>\n";

    // ３列目：PHPコード
    $line = htmlentities($line);
    echo "<td><code class='language-php'>$line</code></td></tr>\n";

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

require './module/footer.php';
?>

<!-- 実装アイデア -->
<!-- エラーが起きた時は、行を取得してその前の行までだけで再実行 -->
<!-- get_defined_vars; exit;を1行だけ入れるのを場所を１つ１つ試していく -->