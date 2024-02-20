<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include './config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];
$sql = "select * from content where id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// $sql = "SELECT id, name, level from user where id = '".$_SESSION['id']."'";
$sql = "SELECT id, name, level from user where id = {$_SESSION['id']}";
$t = $conn->query($sql);
$r = $t->fetch_assoc();
echo $_SESSION['id'];

if ($_SESSION["id"] == $row['member_id'] || $r['level'] == 1) {
	$sql = "DELETE FROM content WHERE id='{$row['id']}'";
	echo $row['id'];
	$conn->query($sql);
	echo "删除成功！";
} else {
	echo "删除失败！";
}
?>