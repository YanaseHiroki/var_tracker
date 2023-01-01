<?php
require './func/element.php';
require './module/header.php';
?>

<h1>ファイル追加</h1>
<form action="track.php" method="post" enctype="multipart/form-data" >
<!-- <input type="file" name="userfile" required multiple/> -->
<input type="file" name="userfile" required>
<input type="submit" value="追加する">
</form>


<?php
require './module/footer.php';
?>