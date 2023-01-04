<?php
require './module/function.php';
require './module/header.php';
?>

<h3>制作の背景</h3><br>
<p>プログラミングにデバッグはつきものです。<br>
しかし、困ったことにPHPではエラーメッセージが出力されません。<br>
これでは何行目でどのような種類のエラーが発生したのかわかりません。</p><br>
<p>通常、このような場面ではvar_dump()関数が多用されます。<br>
あやしい変数を見つけて、その値に変化がありそうなところにvar_dump()関数を埋め込む。。</p><br>
<p>この作業を簡単にしようというデバッグツールが「変数追尾君」です。<br>
PHPファイルをアップロードすると、各行で変数の値を簡単に確認できます。</p><br>
<a href="help.php">使い方(How to use)</a>
<?php
require './module/footer.php';
?>