<?php
echo "Hello!\n";

try {
     $x = new COM('AAA.BBB');
}
catch( Exception $e ) {
     echo $e->getMessage();
}

echo "Bye!\n";

?>