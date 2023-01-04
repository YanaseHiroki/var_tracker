<?php $vars_initial = get_defined_vars();
 
$vars_in_the_way[0] = array_diff(get_defined_vars(),$vars_initial);
$a = 1234;
$vars_in_the_way[1] = array_diff(get_defined_vars(),$vars_initial);
$b = 'foobar';
$vars_in_the_way[2] = array_diff(get_defined_vars(),$vars_initial);
$a /= 0; // Error: Devide by Zero
$vars_in_the_way[3] = array_diff(get_defined_vars(),$vars_initial);
echo 'こちらtestです';
$vars_in_the_way[4] = array_diff(get_defined_vars(),$vars_initial);
unset($a);
$vars_in_the_way[5] = array_diff(get_defined_vars(),$vars_initial);
 $c += 1000; 
$vars_in_the_way[6] = array_diff(get_defined_vars(),$vars_initial);