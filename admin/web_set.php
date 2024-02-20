<?php
include '../config.php'; 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['submit'])){
	$title = $_POST['name'];	
	$sql = "UPDATE info SET title='$title' WHERE id=1";
	// $result = $conn->query($sql);
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	echo "更改网站名字成功~<br>";
	// if($result)
	// {		
	// 	echo "更改网站名字成功~<br>";
	// } else {
	// 	echo "数据库操作错误！";
	// }
}
?>
<form method="post" action="./web_set.php">
网站名字：<input type="" name="name"><br />
<input type="submit" name="submit" value="更改" />
</form>
<a href="./index.php">返回首页</a>
