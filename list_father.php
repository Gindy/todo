<?php
session_start();
include './config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "Select * from father_module";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {

	echo "<br><a href='./forum.php?id={$row['id']}'>".$row['module_name']."</a>";
	$sql = "Select * from father_module where id = {$row["id"]}";
	$re = $conn->query($sql);
	$t = $re->fetch_assoc();
	$sql = "SELECT count(*) as num from content where module_id = {$t['id']}";
	$res = $conn->query($sql);
	$r = $res->fetch_array(); 
	echo "帖子：".$r['num'];
}







if (isset($_POST['submit']))
{
	if ($_POST['name'] != '')
	{

		$name = $_POST['name'];
		$sql = "INSERT INTO father_module (id, module_name)
					 VALUES ('', '$name')";

		if ($conn->query($sql) === TRUE) {
			echo "<br>添加成功";	
			
		}  else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
		echo "<br>板块名称不能为空！";
	}
}

?>
<form method="post" action="./list_father.php">
板块名字：<input type="" name="name"><br />
<input type="submit" name="submit" value="添加板块" />
<br>
<a href="./index.php">返回首页</a>
