<?php
session_start();
if (!$_SESSION['username']) {
	exit("没有登陆！");
}
include './config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$content = $_POST['content'];
	// echo $id;	
	echo $_SESSION['id'];
	$sql = "INSERT INTO content (module_id, title, content, member_id)
	 VALUES ('$id', '$title', '$content', '{$_SESSION['id']}')";
	 if ($conn->query($sql) === TRUE) {
		echo "发帖成功";	
	} else { 
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>
<form method="post" action="./publish.php?id=<?php echo $_GET['id']	?>">

	标题：<input type="" name="title"><br />
	内容：<input type="text" name="content"><br />
	<input type="submit" name="submit" value="发帖" />
</form>
<?php

// <a href="./forum.php">返回论坛</a>

// echo "<a href='./forum.php'>返回论坛</a>";
?>

<a href='./forum.php?id=<?php echo $_GET['id']	?>'>返回论坛</a>
