<?php $vars_initial = get_defined_vars(); ?>
<?php $line = $_REQUEST["line"]; ?>
<?php
if($line != 1) {
echo '<a href="track_error.php?line=1"><u>
                        <code class="language-php">$a = 1;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$a = 1;</code>
                        </u></a><br>';}
$a = 1;
if($line == 1) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 2) {
echo '<a href="track_error.php?line=2"><u>
                        <code class="language-php">$b = 2;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$b = 2;</code>
                        </u></a><br>';}
$b = 2;
if($line == 2) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 3) {
echo '<a href="track_error.php?line=3"><u>
                        <code class="language-php">$c = 3;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$c = 3;</code>
                        </u></a><br>';}
$c = 3;
if($line == 3) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 4) {
echo '<a href="track_error.php?line=4"><u>
                        <code class="language-php">echo ’test-input1.phpです’;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">echo ’test-input1.phpです’;</code>
                        </u></a><br>';}
echo 'test-input1.phpです';
if($line == 4) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 5) {
echo '<a href="track_error.php?line=5"><u>
                        <code class="language-php">$address = $_SERVER["REMOTE_ADDR"] ;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$address = $_SERVER["REMOTE_ADDR"] ;</code>
                        </u></a><br>';}
$address = $_SERVER["REMOTE_ADDR"] ;
if($line == 5) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 6) {
echo '<a href="track_error.php?line=6"><u>
                        <code class="language-php">$host = gethostbyaddr($address) ;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$host = gethostbyaddr($address) ;</code>
                        </u></a><br>';}
$host = gethostbyaddr($address) ;
if($line == 6) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
if($line != 7) {
echo '<a href="track_error.php?line=7"><u>
                        <code class="language-php">echo $host;</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">echo $host;</code>
                        </u></a><br>';}
echo $host;
if($line == 7) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}

try {
if($line != 10) {
echo '<a href="track_error.php?line=10"><u>
                        <code class="language-php">$x = new COM(’AAA.BBB’);</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">$x = new COM(’AAA.BBB’);</code>
                        </u></a><br>';}
$x = new COM('AAA.BBB');
if($line == 10) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
}
catch( Exception $e ) {
if($line != 13) {
echo '<a href="track_error.php?line=13"><u>
                        <code class="language-php">     echo $e->getMessage();</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">     echo $e->getMessage();</code>
                        </u></a><br>';}
     echo $e->getMessage();
if($line == 13) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}
}

if($line != 16) {
echo '<a href="track_error.php?line=16"><u>
                        <code class="language-php">echo "Bye!\n";</code>
                        </u></a><br>';
} else {
echo '<a href="track_error.php"><u>
                        <code class="language-php">echo "Bye!\n";</code>
                        </u></a><br>';}
echo "Bye!\n";
if($line == 16) {
$vars = array_diff(get_defined_vars(),$vars_initial);
error_put_table($vars);}

