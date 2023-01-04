<?php
require './module/function.php';
require './module/header.php';
?>

<h3>使い方(How to use)</h3><br>
<p>[(1) ファイル追加] 画面からPHPファイルをアップロードしてください。</p>
<img src="img/input.png" alt="ファイル追加"><hr>
<p>[(2) 変数追尾] 画面が表示されます。上部の<b>出力内容</b>をクリックするとコードの実行結果が表示されます。</p>
<img src="img/track.png" alt="変数追尾"><hr>
<p><b>行番号</b>をクリックすると、その行のスコープで参照できる変数の値が一覧表示されます。</p>
<p>再度、<b>行番号</b>をクリックすると一覧が閉じます。</p>
<img src="img/track-break.png" alt="ブレイクボタン"><hr>
<p>変数の一覧で<b>変数名</b>をクリックすると、各行におけるその変数の値が１列で表示されます。</p><br>
<p>再度、<b>変数名</b>をクリックすると選択が解除されます。</p>
<img src="img/track-column.png" alt="変数列"><hr>
<a href="file-input.php">ファイル追加へ進む</a><hr>


<?php
require './module/footer.php';
?>