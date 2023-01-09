<?php 

// 数値をだいたい0.66倍して返す関数
function hoge ($num) {
    $tmp = $num;
    for($i=0; $i<10; $i++) {
        $tmp /= -2;
        $num += $tmp;
    }
    return round($num); 
}

echo 'これはtest-input2b.phpです';

?>