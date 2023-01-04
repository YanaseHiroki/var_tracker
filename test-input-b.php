<?php
set_error_handler( 'my_error_handler', E_ALL );

echo "Hello!\n";

try {
     $x = new COM('AAA.BBB');
}
catch( Exception $e ) {
     echo $e->getMessage();
}

echo "Bye!\n";

function my_error_handler ( $errno, $errstr, $errfile, $errline, $errcontext ) {
     echo "[$errno] $errstr $errfile($errline)\n";
}
?>