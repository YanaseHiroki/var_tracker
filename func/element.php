<?php

// ボタン（ラベル、リンク、アクティブかどうか）
function mkbtn($value, $href, $is_primary = false) {
    $class = ($is_primary) ? 'btn bg-primary' : 'btn btn-default';
    return <<<EOT
        <a href="$href" class="$class">$value</a>
        EOT;
}


?>
