<?php
session_start();
include './config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_GET['id'];
if(isset($_POST['submit'])){
	$info = $_POST['info'];
	$sql = "INSERT INTO information (id, info, module_id, level)
	 VALUES ('', '$info','$id', 1)";
	if ($conn->query($sql) == True) {
		echo "发送成功<br>";
		// echo "<a href='./member.php?id={$_SESSION["id"]}'>返回上一级</a>";
	}
}
echo "发送信息给ta：<br>";
?>

<form method="post" action="member.php?id=<?php echo $_GET['id'] ?>">
<input type="text" name="info">
<input type="submit" name="submit" value="发送">
</form>
<?php
$id = $_GET['id'];
echo "id:".$id."<br>";

echo "用户组：";
$sql = "select level from user where id = $id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	if ($row['level'] == 1)
	{
		echo "管理员";
	} else if ($row['level'] == 0) {
		echo "普通用户";
	}
}
// echo $id;
$sql = "select * from content where member_id = {$_SESSION["id"]}";

$result = $conn->query($sql);
$a = 1;
if ($result->num_rows > 0) {
	echo "<br>发过的贴子：<br>";
	while($row = $result->fetch_assoc()) {
		echo $a.".".$row['title']."<br>";
		$a++;
	}
} else {
	echo "<br>还没发过帖子！";
}
echo '<a href="./index.php">返回首页</a>';
?>