<?php
include '../config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "DELETE FROM father_module WHERE id='{$_GET['id']}'";
$result = $conn->query($sql);
if ($result === TRUE) {
	  echo "删除成功<br>";
} else {
  echo "Error deleting record: " . $conn->error;
}
?>
<a href="./manage_list.php">返回</a>