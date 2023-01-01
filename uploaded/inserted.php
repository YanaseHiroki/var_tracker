<?php $vars_initial = get_defined_vars(); 

 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $url = 'mysql1.php.xdomain.ne.jp'; //mysqlサーバー名
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $user = 'yanasehiroki_db'; //ユーザーID
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $pass = 'Way0fxfree'; //パスワード
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $db = 'yanasehiroki_db'; //データベース名
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 

 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $link = mysql_connect($url,$user,$pass) or die("MySQL接続失敗");
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// $sdb = mysql_select_db($db,$link) or die("データベース選択失敗");
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
// echo "good ";
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 

 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 

 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
 
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
try {
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
    // $pdo = new PDO('mysql:dbname=yanasehiroki_db;host=mysql1.php.xdomain.ne.jp;charset=utf8', 'yanasehiroki_db', 'Way0fxfree');
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
    $pdo = new PDO('mysql:dbname=db19;host=127.0.0.1;charset=utf8', 'root', '');
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
} catch (PDOException $e) {
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
    // echo 'DB接続エラー: ' . $e->getMessage();
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
}
 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 

 $vars_in_the_way[] = array_diff(get_defined_vars(),$vars_initial); 
var_export($vars_in_the_way[17]);