<?php
	include '../config.php'; 
	$conn = new mysqli($servername, $username, $password, $dbname);


if ($_GET['id'])
{
	$sql = "DELETE FROM user WHERE id='{$_GET['id']}'";
	global $conn;
	$result = $conn->query($sql);
	if ($result === TRUE) {
		  echo "删除成功<br>";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}
   }
	$sql = "select * from user";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		echo $row['name'];
		echo '<a href="user.php?id='.$row["id"].'">删除</a>'."<br>";
	}
?>
<a href="./index.php">返回首页</a>
