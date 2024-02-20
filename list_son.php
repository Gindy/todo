
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
	<?php
		// 网页标题
		echo $_GET['title'];
		
	?></title>
</head>
<body>


<?php
	session_start();
	include 'config.php';
	include 'common.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	$id = $_GET['id'];
	$sql = "UPDATE liuyan SET view = view+1 WHERE id='$id'";
	$conn->query($sql);
	if(isset($_POST['submit'])){ 
		// if(empty($_GET['content'])){
		//    ExitMessage("内容不得为空");
		// }
		$content = $_POST['content'];
		$username = $_SESSION["username"];
		$sql = "INSERT INTO replay (id, uid, content, cid)
				 VALUES ('', '$id', '$content', '$username')";
		 if ($conn->query($sql) === TRUE) {
			$sql = "select * from replay where uid = $id";
			$result = $conn->query($sql);
			$sql = "UPDATE liuyan SET reply = $result->num_rows WHERE id='$id'";
			$conn->query($sql);
		  echo "回复成功";	
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	//查询数据
	// $sql = "SELECT title, content FROM liuyan where id = '$id'";
	// $result = $conn->query($sql);
	    // output data of each row


    $sql = "SELECT id, title, content,reg_date FROM liuyan where id = '$id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	
		        // echo '<br> 标题: <a href="list_son.php?id='.$row["id"].'&title='.$row["title"].'&content='.$row["content"].'">'.$row["title"]." </a><br>内容: " . $row["content"] . "<br>";

		    	echo '<br> 标题: '.$row["title"]."<br>";
 // echo "发表于：" . format_date
    // ("2024-02-19 16:14:00"); 

				echo "发表于：" . format_date($row["reg_date"]); 
		    	echo" <br>内容: " . $row["content"] . "<br>";
		        echo '<a href="index.php?id='.$row["id"].'">删除</a>-';
		        echo '<a href="edit.php?id='.$row["id"].'">修改</a>';
		        echo "-".mb_strwidth($row["content"])."字";
		        // echo '<a href="edit.php?id='.$row["id"].'">修改</a>';
		    }
		} else {
		    echo "0 results";
		}
	
		


    	// echo '<br> 标题: '.$row["title"].'<br>内容: " . $row["content"] .;
        // echo '<a href="newliuyan.php?id='.$row["id"].'">删除</a>-';
        // echo '<a href="newliuyan.php?id='.$row["id"].'">修改</a>';
	// echo $_SESSION["username"];

?>
<?php
// $result = $conn->query("SELECT cid from replay where uid = $id");
// $user
// while ($row = $result->fetch_assoc())
// 	{
// 		$user = $row["cid"];
// 	}




$id = $_GET['id'];



$sql = "SELECT cid from liuyan where id = '$id'";

$result =  $conn->query($sql);
$row = $result->fetch_assoc();


$t = "SELECT * from liuyan where id = '$id'";
$r =  $conn->query($t);
$ro = $r->fetch_assoc();
header("Content-type:text/html;charset=utf-8");
	echo "<br>";
	echo "楼主："."<a href='member.php?id={$ro['uid']}'>".$row['cid']."</a>";
	echo "<br>回复列表：";
	$sql = "SELECT content,cid FROM replay where uid = '$id' ORDER BY id DESC";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	
				
		    	  echo " <br>"."<a href='member.php?id={$ro['uid']}'>".$row['cid']."</a>".": " . $row["content"] ;
		    }
		} else {
		    echo "0 条回复";
		}
include "./templates/list_son.php";



function format_date($dateStr) {  
	$limit = strtotime(date('Y-m-d H:i:s'),time()) - strtotime($dateStr);  

	$r = "";  
	if($limit < 60) {  
	$r = '刚刚';  
	} elseif($limit >= 60 && $limit 
	< 3600) {  
	$r = floor($limit / 60) . '分钟前';  
	} elseif($limit >= 3600 && $limit 
	< 86400) {  
	$r = floor($limit / 3600) . '小时前';  
	} elseif($limit >= 86400 && $limit 
	< 2592000) {  
	$r = floor($limit / 86400) . '天前';  
	} elseif($limit >= 2592000 && $limit 
	< 31104000) {  
	$r = floor($limit / 2592000) . '个月前';  
	} else {  
	$r = "很久前";  
	}  
	return $r;  
	}   
echo "<br>";

	?>
    <!-- echo '你好！'."<a href='./member.php?id={$_SESSION["id"]}'>{$_SESSION["username"]}</a>-"."<a href='./offlogin.php'>退出登陆</a>"; -->
