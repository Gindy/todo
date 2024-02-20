<?php
session_start();
include './config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select * from information where module_id = '{$_SESSION['id']}' and level = 1";
$result = $conn->query($sql);
$i = 1;
echo "新信息：<br>";
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo $i.".".$row['info']."<br>";
		$i++;
	}
}

$sql = "UPDATE information SET level='0' WHERE module_id = '{$_SESSION['id']}'";
$conn->query($sql);

echo "已阅读的信息：<br>";
$sql = "select * from information where module_id = '{$_SESSION['id']}' and level = 0 ORDER BY id DESC";
$result = $conn->query($sql);
$i = 1;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo $i.".".$row['info']."<br>";
		$i++;
	}
}
echo "<a href='./index.php'>返回首页</a>";
?>