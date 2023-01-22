<?php $vars_initial = get_defined_vars(); ?>
<?php
require 'test-input2b.php';$vars_in_the_way[1] = array_diff(get_defined_vars(),$vars_initial);

    $a = 1000;$vars_in_the_way[3] = array_diff(get_defined_vars(),$vars_initial);
    $b = 'foobar';$vars_in_the_way[4] = array_diff(get_defined_vars(),$vars_initial);
    $c = hoge($a);$vars_in_the_way[5] = array_diff(get_defined_vars(),$vars_initial);
    $a /= 0;$vars_in_the_way[6] = array_diff(get_defined_vars(),$vars_initial);
    echo 'こちらtestです。$cは', $c, 'です。';$vars_in_the_way[7] = array_diff(get_defined_vars(),$vars_initial);
    unset($a);$vars_in_the_way[8] = array_diff(get_defined_vars(),$vars_initial);
?>
<h3>htmlです</h3>
<?php
$c += 1000;$vars_in_the_way[12] = array_diff(get_defined_vars(),$vars_initial);
?>