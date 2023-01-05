<?php
session_start();
session_unset();
require './module/function.php';
require './module/header.php';

// エラー表示設定を解除
// ini_set( 'display_errors' , 0 );

// ダウンロードフォルダを削除する
if (file_exists('download')) remove_directory('download');
?>

<!-- JavaScript -->
<script type="text/javascript" language="javascript">
<!--
function OnFileSelect( inputElement )
{
    // ファイル情報を取得
    const fileList = inputElement.files;
    const fileCount = fileList.length;
 
    // HTML文字列の生成
    let fileListBody = "<br><br><b>確認したい主なファイルを選択</b><br>";
    for ( let i = 0; i < fileCount; i++ ) {
        let file = fileList[ i ];
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
そのファイルの処理の途中で(requireなどで）参照するファイルがあれば一緒に選択してください。</p>

<p><b>対応ファイル情報：</b><br>
別ファイル参照に対応しました（修正済み）。<br>
htmlとphpの混在に対応しています。<br>
try catch文に一部非対応です。</p><br>

<label for="upload_file">確認したいファイルと参照するファイル（複数選択可）</label>
<input type="file" name="upload_file[]" id="upload_file" onchange="OnFileSelect( this );" multiple required>
<p id="ID001" ></p>
<input type="submit" value="追加">
</form>

<?php
require './module/footer.php';
?>