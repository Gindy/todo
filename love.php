<?php
header("Content-type:text/html;charset=utf-8");

include 'config.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_GET['id'];
$sql = "UPDATE liuyan SET love = love+1 WHERE id='$id'";
$result=$conn->query($sql);

if($result)
{		

	//跳转页面
	// header("Location: ../newliuyan.php?id=$id");
	echo "成功";
}
else {
	echo "数据库操作错误！";
}
?>
<a href="../bbs/index.php">返回首页</a>
