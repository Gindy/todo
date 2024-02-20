<?php
include '../config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['info']))
{
	$selectedInfo = $_GET['info'];
	foreach ($selectedInfo as $info) {
		echo $info;
		// $sql = "DELETE FROM information WHERE id='{$_GET['info']}'";
		$sql = "DELETE FROM information WHERE id=$info";
		$result = $conn->query($sql);
		if ($result === TRUE) {
			  echo "删除成功<br>";
		} else {
		  echo "Error deleting record: " . $conn->error;
		}
	}
}


?>
 <a href="./all_info.php">返回</a>