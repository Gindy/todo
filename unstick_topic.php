<?php

include 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$id=$_POST['id'];
echo $id;
$sql = "UPDATE liuyan SET sticky='0' WHERE id='$id'";

$result=$conn->query($sql);

if($result)
{		

	//跳转页面
	header("Location: index.php?id=$id");
}
else {
	ExitMessage("数据库操作错误！");
}

?>