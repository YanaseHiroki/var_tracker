<?php 

// 数値をだいたい0.8倍して返す関数
function hoge ($num) {
    $tmp = $num;
    for($i=0; $i<10; $i++) {
        $tmp /= -2;
        $num += $tmp;
    }
    return $num; 
}

?>