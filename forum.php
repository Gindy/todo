
<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include './config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];

	// echo "<br><a href='./forum.php?id={$row['id']}'>".$row['module_name']."</a>";


echo "<a href='./publish.php?id=$id'>发帖</a>";
$sql = "select * from content where module_id = '$id'";
$result = $conn->query($sql);
$a = 1;

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc())
	{	
		// echo "<br>".$a.".".'<a href="list_son.php?id='.$id.'">'$row['title']."</a>";

	 echo "<br>".$a.'. <a href="list_son.php?id='.$row["id"].'">'.$row["title"]." </a>" ;

	$sql = "select * from content where id = {$row["id"]}";
	$n = $conn->query($sql);
	$u = $n->fetch_assoc(); 	

if (!$_SESSION['id']) {
	echo '<br><a href="./list_father.php">返回论坛首页</a>';
	exit();
}
	$sql = "SELECT id, name, level from user where id = {$_SESSION['id']}";

	$t = $conn->query($sql);
	$r = $t->fetch_assoc();
	 if (($_SESSION["id"] == $u['member_id']) || ($r['level'] == 1)) {
	 	echo "---";
	 	echo '<a href="ad_delete.php?id='.$row["id"].'">删除</a>';
	 } 
		$a++;
	}
} else {
	echo "<br>没有帖子!";
}

 // echo $a.'.标题: <a href="list_son.php?id='.$row["id"].'">'.$row["title"]." </a>;

// if ($id == "add")
// {
// 	echo "1";
// }
?>
<br><a href="./list_father.php">返回论坛首页</a>
