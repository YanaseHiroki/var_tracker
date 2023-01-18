<?php
session_start();
require './module/function.php';
require './module/header.php';

// エラー表示設定を解除
ini_set( 'display_errors' , 0 );

// ダウンロードフォルダを削除する
$main_file_dir = $_SESSION['main_file_dir'];
if (file_exists($main_file_dir)) remove_directory($main_file_dir);
session_unset();
?>

<form method="post" enctype="multipart/form-data" id="myForm" name="myForm">
    <h3>(1) ファイル追加</h3><br>

    <p>変数の値を確認したいファイルを選択してください。<br>
    そのファイルの処理の途中で(requireなどで）参照するファイルがあれば一緒に選択してください。</p>

    <p><b>対応ファイル情報：</b><br>
    htmlとphpの混在に対応しました。<br>
    try catch文に対応しました。<br>
    異なるディレクトリにあるファイルの参照に対応しました(動作環境はWebkit限定です)。</p><br>

    <label for="file">アップロードするフォルダを選択してください</label>
    <input type="file" name="upfile[]" webkitdirectory><br>
    <input type="submit" name="btn" value="追加" onclick="funcBtn();" />
</form>


<script type="text/javascript">

var input = document.getElementById('myForm');
var ele = document.createElement('input');
var files;

input.onchange = function(e) {
  files = e.target.files; // FileList
};

function funcBtn() {
    var ary = [];

    // 相対パスを一つの文字列にまとめる
    for (var i = 0, f; f = files[i]; ++i){
        ary.push(files[i].webkitRelativePath);
    }
    var str = ary.join(',');
    // エレメントを作成
    var ele = document.createElement('input');
    ele.setAttribute('type', 'hidden');
    ele.setAttribute('name', 'file_path');
    ele.setAttribute('value', str);
    document.myForm.appendChild(ele);
}

</script>

</body>
</html>

<?php
// ホスト名を取得
$address = $_SERVER["REMOTE_ADDR"] ;
$host = gethostbyaddr($address) ;

if(!isset($_FILES) || !isset($_POST['file_path'])){
    echo "ディレクトリを追加すると、その中のファイル一覧が表示されます。";
}else{
    $copy_path = explode(',', $_POST['file_path']);

    echo "<form action='track_ok.php' method='post' enctype='multipart/form-data' >";
    echo "<br><p>変数の値を確認したいファイルを選んでください。</p>";
    for($i = 0; $i < count($copy_path); $i++){

        //ディレクトリが存在しなかったら作る。
        if(!file_exists("./dl/$host/" . dirname($copy_path[$i]))){
            if(!mkdir("./dl/$host/" . dirname($copy_path[$i]), 0755, true)){
                die("mkdirに失敗しました");
            }
        }
        //tmpファイルからコピーする
        if(copy($_FILES["upfile"]["tmp_name"][$i], "./dl/$host/" . $copy_path[$i])){
            $input = "<input type='radio' name='main_file' value='./dl/$host/{$copy_path[$i]}' id='$i' required>";
            echo $input, "<label for='$i'>{$copy_path[$i]}</label><br>";
        }
    }
    echo "<input type='submit' value='追加'></form>";
}  

require 'module/footer.php';
?>