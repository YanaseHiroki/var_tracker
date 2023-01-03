<?php

// ボタン（ラベル、リンク、アクティブかどうか）
function mkbtn($value, $href, $is_primary = false) {
    $class = ($is_primary) ? 'btn bg-primary' : 'btn btn-default';
    return <<<EOT
        <a href="$href" class="$class">$value</a>
        EOT;
}

// 配列を受け取り、各要素のタグを代わりの文字に置き換えて配列を返す関数
function h ($arr) {
    foreach ($arr as &$str) {
      $str = htmlspecialchars($str);
    }
    return $arr;
} 
  
  
// var_export
function e($str) {
    global ${$str};
    echo "<pre><b>$$str</b><hr>", var_export(${$str}), '</pre>';
}


ini_set( 'display_errors' , 1 );
// エラーハンドラ設定
// error_reporting( E_ALL );
// register_shutdown_function( 'myShutdownHandler' );
// set_error_handler('myErrorHandler');
// set_exception_handler( 'myExceptionHandler' );

// // エラーハンドラ
// function myErrorHandler($errno, $errstr, $errfile, $errline)
// {
//     echo "<br><b>Error[$errno]: $errstr</b>
//           <br>File: $errfile
//           <br>(Line: $errline)<br>";
// }

// // 例外処理
// function myExceptionHandler ( $e ) {
//     echo '<br><b>Exception: ' . $e->getMessage() . 
//           '</b><br>File: ' . $e->getFile() . 
//           '<br>(Line: ' . $e->getLine() . ')<br>';
// }

// // Fatal Errorの処理
// function myShutdownHandler(){
//     $isError = false;
//     if ($error = error_get_last()){
//         switch($error['type']){
//         case E_ERROR:
//         case E_PARSE:
//         case E_CORE_ERROR:
//         case E_CORE_WARNING:
//         case E_COMPILE_ERROR:
//         case E_COMPILE_WARNING:
//             $isError = true;
//             break;
//         }
//     }
//     if ($isError){
//         echo myErrorHandler( 
//             $error['type'], 
//             $error['message'], 
//             $error['file'], 
//             $error['line'], 
//             null );
//     }
// }

?>
