<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>変数追尾君</title>
</head>
<body>
<div class="wrapper">
    
    <!-- header -->
    <div class="navbar-fixed-top bg-info" style="padding:0 .5em .7em">
        <a href="test.php"><h4><b>変数追尾君(Variable tracker)</b></h4></a>

        <div class="btn-group">
            <?php 
            $file = basename($_SERVER['PHP_SELF']);
                if ($file === 'file-input.php') {
                $is_primary = [1, 0];
            } elseif ($file === 'track.php') {
                $is_primary = [0, 1];
            } else {
                $is_primary = [0, 0];
            }
            echo mkbtn('ファイル追加', 'file-input.php',$is_primary[0]);
            echo mkbtn('変数追尾', 'track.php',$is_primary[1]);
            ?>
        </div>
    </div>

    <!-- main contents -->
    <div class="text-center" style="padding:8em 1em 0"><!-- コンテンツ -->