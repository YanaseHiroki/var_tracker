<?php

// ボタンを出力する関数
// （引数：ラベル、リンク、アクティブかどうか）
function mkbtn($value, $href, $is_primary = false) {
    $class = ($is_primary) ? 'btn bg-primary' : 'btn btn-default';
    return "<a href='$href' class='$class'>$value</a>";
}

// 配列を受け取り、各要素のタグを代わりの文字に置き換えて配列を返す関数
function h ($arr) {
    foreach ($arr as $str) {
      $ret[] = htmlspecialchars($str);
    }
    return $ret;
} 
  
// デバッグ用：　タイトル付きvar_export
function e($str) {
    global ${$str};
    echo "<pre><b>$$str</b><hr>", var_export(${$str}), '</pre>';
}

// 再帰的にディレクトリを削除する関数
function remove_directory($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        // ファイルかディレクトリによって処理を分ける
        if (is_dir("$dir/$file")) {
            // ディレクトリなら再度同じ関数を呼び出す
            remove_directory("$dir/$file");
        } else {
            // ファイルなら削除
            unlink("$dir/$file");
        }
    }
    // 指定したディレクトリを削除
    return rmdir($dir);
}

// PHPの中の行末セミコロンの直後にスクリプトを埋め込む関数(track_ok.php)
function semicolon_insert($contents) {
    $inserted[] = '<?php $vars_initial = get_defined_vars(); ?>';
    $i=0;                                       // $i: $contentsの行番号
    foreach ($contents as $line) {  
        if(';' === substr($line, -1)) {
            $inserted[] = $line . 
                    '$vars_in_the_way[' . 
                    $i . 
                    '] = array_diff(get_defined_vars(),$vars_initial);';
        } else {
            $inserted[] = $line;
        }
        $i++;
    }
    return $inserted;
}

// PHPを受け取り、各セミコロンの場所で定義されている変数の値を返す関数(track_ok.php)
function semicolon_vars($inserted, $main_file, $is_open = '') {
    $info = pathinfo($main_file);
    $inserted_path = $info['dirname'] . '/' . $info['filename'] . '_-ins.php';


    // 配列$contentsを文字列に結合（改行コード区切り）
    $inserted_str = implode("\n", $inserted);

    // 新規ファイルとして保存
    file_put_contents($inserted_path, $inserted_str);

    // エラー表示設定をTRUEにする
    ini_set( 'display_errors' , 1 );

    // メインファイルを呼び出して実行、各セミコロンの場所での変数を取得
    echo "<details $is_open><summary>出力内容▼</summary>";
    try {
        include $inserted_path;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo '</details>';

    // エラー表示設定を解除
    ini_set( 'display_errors' , 0 );

    return $vars_in_the_way;
}


// 変数と値の連想配列を受け取り表形式で出力する関数(track_error.php)
function error_put_table ($vars) {
    unset($vars['line']);
    echo "</table></pre><pre class='variables'><table><tr class='name'><th>変数</th><th>値</th></tr>\n";
    foreach ($vars as $name => $value) {
        echo "<tr><td><a href='./track_error.php?var=$name'><button>$$name</button></a></td><td>\n";
        var_dump($value);
        echo "</td></tr>\n";
    }        
    echo "</table></pre>\n";
}
?>