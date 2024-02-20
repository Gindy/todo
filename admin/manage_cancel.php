<?php
include '../config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$sql = "UPDATE user set level = 0 where id=$id";
	if ($conn->query($sql) === TRUE) {
		echo "取消管理成功！<br>";
	}
}
echo "输入id：";
?>
<form method="post" action="./manage_cancel.php">
<input type="text" name="id">
<input type="submit" name="submit" value="取消管理">

</form>
<a href="manage.php">返回</a>
<a href="./index.php">返回首页</a>