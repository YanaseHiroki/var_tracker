<?php
// $url = 'mysql1.php.xdomain.ne.jp'; //mysqlサーバー名
// $user = 'yanasehiroki_db'; //ユーザーID
// $pass = 'Way0fxfree'; //パスワード
// $db = 'yanasehiroki_db'; //データベース名

// $link = mysql_connect($url,$user,$pass) or die("MySQL接続失敗");
// $sdb = mysql_select_db($db,$link) or die("データベース選択失敗");
// echo "good ";
?>

<?php 
try {
    // $pdo = new PDO('mysql:dbname=yanasehiroki_db;host=mysql1.php.xdomain.ne.jp;charset=utf8', 'yanasehiroki_db', 'Way0fxfree');
    $pdo = new PDO('mysql:dbname=db19;host=127.0.0.1;charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
}
?>