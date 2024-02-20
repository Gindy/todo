<?php

	include '../config.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$sql = "UPDATE user SET level='1' WHERE name='$name'";
		$result=$conn->query($sql);
		if($result)
		{		
			echo "添加管理成功~<br>";
		} else {
			echo "数据库操作错误！";
		}
	}
	$sql = "select * from user";
	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc())
	{	
		echo $row['name']."<br>";
	}

?>
<form method="post" action="./manage_add.php">
名字：<input type="" name="name"><br />
<input type="submit" name="submit" value="添加管理" />
<a href="./manage.php">返回添加管理页面</a>
