<?php
$a = 1;
$b = 2;
$c = 3;
echo 'test-input1.phpです';
$address = $_SERVER["REMOTE_ADDR"] ;
$host = gethostbyaddr($address) ;
echo $host;
?>
