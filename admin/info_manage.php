
<?php
	include '../config.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if(isset($_POST['submit'])){
	$info = $_POST['info'];
	$id = $_GET['id'];
		$sql = "INSERT INTO information (id, info, module_id, level)
		 VALUES ('', '$info','$id', 1)";
		if ($conn->query($sql) == True) {
			echo "发送成功";
			echo "<a href='./info.php'>返回上一级</a>";
			exit();
		}
	}
	echo "发送消息给";
	$sql = "select * from user where id = {$_GET['id']}";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	echo $row['name'];
?>
<form method="post" action="./info_manage.php?id=<?php echo $_GET['id'] ?>">
<input type="text" name="info">
<button type="submit" name="submit" class="btn btn-primary">发送</button>
</form>
<a href="./info.php">返回</a>