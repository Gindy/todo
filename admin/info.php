<?php
	include '../config.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select * from user";
	$result = $conn->query($sql);
	echo "管理会员：<br>";
	while ($row = $result->fetch_assoc()) {
		echo $row['name'];
		echo "<a href='./info_manage.php?id={$row['id']}'>发送消息</a><br>"; 
	}

?>
<a href="all_info.php">管理所有信息</a>
<a href="index.php">返回管理首页</a>


