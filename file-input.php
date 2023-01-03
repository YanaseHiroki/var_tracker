<?php
require './module/function.php';
require './module/header.php';
?>

<!-- JavaScript -->
<script type="text/javascript" language="javascript">
<!--
function OnFileSelect( inputElement )
{
    // ファイルリストを取得
    const fileList = inputElement.files;
 
    // ファイルの数を取得
    const fileCount = fileList.length;
 
    // HTML文字列の生成
    let fileListBody = "<br><br><b>確認したいファイルを選択</b><br>";
 
    // 選択されたファイルの数だけ処理する
    for ( let i = 0; i < fileCount; i++ ) {
 
        // ファイルを取得
        let file = fileList[ i ];
 
        // ファイルの情報を文字列に格納
        fileListBody += '<input type="radio" name="main_file" value="' + file.name + '" id="' + i + '" required> ' + 
                        '<label for="' + i + '"> ' + file.name + "</label><br>";
    }
 
    // 結果のHTMLを流し込む
    document.getElementById( "ID001" ).innerHTML = fileListBody;
}
// -->
</script>

<form action="track.php" method="post" enctype="multipart/form-data" >
<h3>(1) ファイル追加</h3><br>

<p>変数の値を確認したいファイルを選択してください。<br>
    そのファイルの処理の途中で(requireなどで）参照するファイルがあれば一緒に選択してください。</p><br>

<label for="upload_file">確認したいファイルと参照するファイル（複数可）</label>
<input type="file" name="upload_file" id="upload_file[]" onchange="OnFileSelect( this );" multiple required>
<p id="ID001" ></p>
<input type="submit" value="追加">
</form>

<?php
require './module/footer.php';
?>