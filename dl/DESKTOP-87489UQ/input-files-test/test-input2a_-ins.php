<?php $vars_initial = get_defined_vars(); ?>
<?php $line = $_REQUEST["line"]; ?>
<?php
if($line != 1) {
echo '<a href="track_error.php?line=1"><u>
                        <code class="language-php">require ’test-input2b.php’;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">require ’test-input2b.php’;</code>
                        </u></a><br>';}
require 'test-input2b.php';
if($line == 1) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}

if($line != 3) {
echo '<a href="track_error.php?line=3"><u>
                        <code class="language-php">    $a = 1000;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    $a = 1000;</code>
                        </u></a><br>';}
    $a = 1000;
if($line == 3) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 4) {
echo '<a href="track_error.php?line=4"><u>
                        <code class="language-php">    $b = ’foobar’;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    $b = ’foobar’;</code>
                        </u></a><br>';}
    $b = 'foobar';
if($line == 4) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 5) {
echo '<a href="track_error.php?line=5"><u>
                        <code class="language-php">    $c = hoge($a);</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    $c = hoge($a);</code>
                        </u></a><br>';}
    $c = hoge($a);
if($line == 5) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 6) {
echo '<a href="track_error.php?line=6"><u>
                        <code class="language-php">    $a /= 0;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    $a /= 0;</code>
                        </u></a><br>';}
    $a /= 0;
if($line == 6) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 7) {
echo '<a href="track_error.php?line=7"><u>
                        <code class="language-php">    echo ’こちらtestです。$cは’, $c, ’です。’;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    echo ’こちらtestです。$cは’, $c, ’です。’;</code>
                        </u></a><br>';}
    echo 'こちらtestです。$cは', $c, 'です。';
if($line == 7) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 8) {
echo '<a href="track_error.php?line=8"><u>
                        <code class="language-php">    unset($a);</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">    unset($a);</code>
                        </u></a><br>';}
    unset($a);
if($line == 8) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
?>
<h3>htmlです</h3>
<?php
if($line != 12) {
echo '<a href="track_error.php?line=12"><u>
                        <code class="language-php">$c += 1000;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$c += 1000;</code>
                        </u></a><br>';}
$c += 1000;
if($line == 12) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 13) {
echo '<a href="track_error.php?line=13"><u>
                        <code class="language-php">$c += 1000;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$c += 1000;</code>
                        </u></a><br>';}
$c += 1000;
if($line == 13) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}