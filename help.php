<?php
require './module/function.php';
require './module/header.php';
?>

<h3>使い方(How to use)</h3><br>
<<<<<<< Updated upstream
<p>[(1) ファイル追加] 画面からPHPファイルをアップロードしてください。</p>
<img src="img/input.png" alt="ファイル追加"><hr>
=======
<p>[(1) ディレクトリ追加] 画面からPHPファイルがある<b>ディレクトリ</b>（フォルダー）を選択してアップロードしてください。</p>
<img src="img/input.png" alt="ファイル追加"><hr>
<p>画面下に表示されるファイル一覧から<b>変数を確認したいファイル</b>を１つ選択してください。</p>
<img src="img/select.png" alt="ファイル追加"><hr>
>>>>>>> Stashed changes
<p>[(2) 変数追尾] 画面が表示されます。上部の<b>出力内容</b>をクリックするとコードの実行結果が表示されます。</p>
<img src="img/track.png" alt="変数追尾"><hr>
<p><b>行番号</b>をクリックすると、その行のスコープで参照できる変数の値が一覧表示されます。</p>
<p>再度、<b>行番号</b>をクリックすると一覧が閉じます。</p>
<img src="img/track-break.png" alt="ブレイクボタン"><hr>
<p>変数の一覧で<b>変数名</b>をクリックすると、各行におけるその変数の値が１列で表示されます。</p>
<p>再度、<b>変数名</b>をクリックすると選択が解除されます。</p>
<p>（このツールでは、行の最後に「;」があれば変数を取得しています）</p>
<img src="img/track-column.png" alt="変数列"><hr>
<<<<<<< Updated upstream
<a href="file-input.php">ファイル追加へ進む</a><hr>

=======
<p>上部の<b>[(3) エラーあり]</b> をクリックすると、最後まで処理が流れないコードのための分析ツールが開きます。</p>
<p>エラーで止まるまでのecho文などの出力と、PHPが一緒に表示されます。</p>
<img src="img/error.png" alt="変数列"><hr>
<p>出力内容の中にある<b>PHPリンク</b>をクリックすると、その行における変数の値が表形式で表示されます。</p>
<p>再度、<b>PHPリンク</b>をクリックすると表が非表示になります。</p>
<img src="img/error-break.png" alt="変数列"><hr>
<a href="file-input.php" class="btn bg-primary">ディレクトリ追加へ進む</a>
>>>>>>> Stashed changes

<?php
require './module/footer.php';
?>