<?php

include '../config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select * from user where level = 1";

$info=$conn->query($sql);
echo "管理员列表：<br>";
if ($info->num_rows > 0)
{
	While($it=$info->fetch_assoc())
	{
		echo $it['name']."<br>";
	}
} else {
	echo "没有管理员！<br>";
}





?>	

<a href="manage_add.php">添加管理员</a>
<a href="./manage_cancel.php">取消管理</a>
<a href="./index.php">返回首页</a>

