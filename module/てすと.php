<?php $vars_initial = get_defined_vars(); ?>
<?php $a=1;$b=2;
$vars_in_the_way[] =  array_diff(get_defined_vars(),$vars_initial);
$c=3;
$vars_in_the_way[] =  array_diff(get_defined_vars(),$vars_initial);
echo 123;