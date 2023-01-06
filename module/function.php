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

    return $vars_line;

}
?>