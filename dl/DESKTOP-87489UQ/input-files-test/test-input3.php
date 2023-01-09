<?php
$a = 1;
$b = 2;
$c = 3;
echo 'test-input1.phpです';
$address = $_SERVER["REMOTE_ADDR"] ;
$host = gethostbyaddr($address) ;
echo $host;

try {
$x = new COM('AAA.BBB');
}
catch( Exception $e ) {
     echo $e->getMessage();
}

echo "Bye!\n";

?>