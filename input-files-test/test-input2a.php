<?php 
require 'test-input2b.php';

$a = 1000;
$b = 'foobar';
$c = hoge($a);
$a /= 0; // Devide by Zero
echo 'こちらtestです。$cは', $c, 'です。';
unset($a);
?>
<h3>htmlです</h3>
<?php
$c += 1000;
?>