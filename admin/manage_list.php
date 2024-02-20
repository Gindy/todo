<?php
include '../config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select * from father_module";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	echo $row["module_name"];
	echo "<a href='./manage_list_delete.php?id={$row['id']}'>删除</a>";
	echo "<br>";
}
?>
<a href="./index.php">返回管理首页</a>