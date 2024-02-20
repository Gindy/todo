<?php
include '../config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);
echo "添加不允许的字符：";


if(isset($_POST['submit'])){ 
	$content = $_POST["content"];


    $sql ="INSERT INTO manage_str (content) VALUES ('$content')";

    $result = $conn->query($sql);
    if (!$result)
    {
    	echo $conn->error;
    }

	// $sql = "select * from admin_str";
	// $result = $conn->query($sql);
	// if ($result->num_rows > 0) {
	// 	while ($row = $result->fetch_assoc()) {
	// 		echo "<br>".$row["content"]."<a href='./manage_str_delete.php?id={$row['id']}'>删除</a>";
	// 	}
	// }
}

$sql = "select * from manage_str";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<br>".$row["content"]."<a href='./manage_str_delete.php?id={$row['id']}'>删除</a>";
	}
}
?>

<form method="post" action="./manage_str.php">
<input type="text" name="content">
<button type="submit" name="submit">提交</button>
<a href="./index.php">返回首页</a>