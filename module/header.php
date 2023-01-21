<?php function ver() {echo 'ver.0.2.3';}; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/prism.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/prism.js"></script>
    <title>変数追尾君</title>
</head>
<body>
<div class="wrapper">
    
    <!-- header -->
    <div class="navbar-fixed-top bg-info" style="padding:0 .5em .7em">
        <a href="why.php"><h4><b>変数追尾君(Variable tracker)</b>
        <?php ver(); ?></h4></a>
        
        <div class="btn-group">
            <?php 
            $file = basename($_SERVER['PHP_SELF']);
            if ($file === 'file-input.php') {
                $is_primary = [1, 0, 0];
            } elseif ($file === 'track_ok.php') {
                $is_primary = [0, 1, 0];
            } elseif ($file === 'track_error.php') {
                $is_primary = [0, 0, 1];
            } else {
                $is_primary = [0, 0, 0];
            }
            echo mkbtn('(1) ディレクトリ追加', 'file-input.php',$is_primary[0]);
            echo mkbtn('(2) 変数追尾', 'track_ok.php',$is_primary[1]);
            echo mkbtn('(3) エラーあり', 'track_error.php',$is_primary[2]);
            ?>
        </div>
    </div>

    <!-- main contents -->
    <div class="text-center" style="padding:6em 1em"><!-- コンテンツ -->