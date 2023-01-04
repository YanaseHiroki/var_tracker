<?php

// ボタン（ラベル、リンク、アクティブかどうか）
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
  
  
// タイトル付きvar_export
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

?>