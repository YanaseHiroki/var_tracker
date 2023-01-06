<?php

// ボタンを出力する関数
// （引数：ラベル、リンク、アクティブかどうか）
function mkbtn($value, $href, $is_primary = false) {
    $class = ($is_primary) ? 'btn bg-primary' : 'btn btn-default';
    return "<a href='$href' class='$class'>$value</a>";
}

// 配列を受け取り、各要素のタグを代わりの文字に置き換えて配列を返す関数
function h ($arr) {
    foreach ($arr as &$str) {
      $str = htmlspecialchars($str);
    }
    return $arr;
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

// $contentsに読み込んだコードからhtmlを削除する関数
function trim_html ($contents) {
    $contents_str = implode("NeXtLiNe", $contents);
    preg_match_all('/\?php.+?\?>/', $contents_str, $contents_arr);
    $contents_arr = $contents_arr[0];
    for($i=0; $i<count($contents_arr); $i++) {
        $contents_arr[$i] = str_replace('?php', '', $contents_arr[$i]);
        $contents_arr[$i] = str_replace('?>', '', $contents_arr[$i]);
    }
    $contents_str = implode("NeXtLiNe", $contents_arr);
    $contents_arr = explode("NeXtLiNe", $contents_str);
    return array_filter($contents_arr);
}

// PHPを受け取り、指定された行で定義されている変数の値を返す関数
// （引数：PHP（配列）、行番号、ダウンロードフォルダのパス）
function inspect_line ($contents, $i, $path) {
    $gdv = '$vars_line = array_diff(get_defined_vars(),$vars_initial);';
    echo $contents[0];
    array_splice($contents, $i, 0, $gdv);
    array_unshift($contents, '<?php $vars_initial = get_defined_vars(); ?>');

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
    
    // 各行の変数を返す
    return $vars_line;

}




// PHPの中の行末セミコロンがそれぞれ何行目にあるか配列で返す関数
function semicolon_place($contents) {
    $i=0;                                       // $i: $contentsの行番号
    foreach ($contents as $line) {  
        $line = trim($line);
        if(';' === substr($line, -1)) {
            $ret[] = $i;
        }
        $i++;
    }
    return $ret;
}

// PHPを受け取り、各セミコロンの場所で定義されている変数の値を返す関数
function semicolon_vars($contents, $path, $main_file) {
    // 配列$contentsを文字列に結合（改行コード区切り）
    $contents_str = implode("\n", $contents);

    // セミコロンの直後に変数を取得するスクリプトを埋め込む
    $script = ";\n" . '$vars_in_the_way[] =  array_diff(get_defined_vars(),$vars_initial);' . "\n";
    $contents_str = str_replace( ";\n" ,$script , $contents_str);

    // 文字列の先頭にもget_defined_vars()関数を埋め込む（比較対象）
    $contents_str = '<?php $vars_initial = get_defined_vars(); ?>' . "\n" . $contents_str;

    // メインファイル名でファイルとして保存
    file_put_contents( "$path/$main_file.php", $contents_str);

    // エラー表示設定をTRUEにする
    ini_set( 'display_errors' , 1 );

    // メインファイルを呼び出して実行、各セミコロンの場所での変数を取得
    echo '<details><summary>出力内容▼</summary>';
    try {
        include "$path/$main_file.php";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo '</details>';

    // エラー表示設定を解除
    ini_set( 'display_errors' , 0 );

    return $vars_in_the_way;
}

// 各行での最終的な変数を決定する関数
function vars_in_the_way ($semicolon_place, $vars_semicolon) {
    // メインファイルの各行について処理
    for ($i=0; $i<count($semicolon_place); $i++) {
        $line_num = $semicolon_place[$i];                   //そのセミコロンが何行目にあるか
        $vars_in_the_way[$line_num] = $vars_semicolon[$i]; //そのセミコロンでの変数をその行での変数にする
    }
    return $vars_in_the_way;
}
?>