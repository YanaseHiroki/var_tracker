<?php $vars_initial = get_defined_vars();
 
$vars_in_the_way[0] = array_diff(get_defined_vars(),$vars_initial);
$a = 1;
$vars_in_the_way[1] = array_diff(get_defined_vars(),$vars_initial);
$a++; 
$vars_in_the_way[2] = array_diff(get_defined_vars(),$vars_initial);
 $b = 3; 
$vars_in_the_way[3] = array_diff(get_defined_vars(),$vars_initial);