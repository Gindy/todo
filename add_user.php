<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


<?php
session_start(); //启动Session
function ExitMessage($message, $url='')
{
	echo '<p class="message">';
	echo $message;
	echo '<br>';
	if($url){
    	echo '<a  href="'.$url.'">返回</a>';
    }else{
    	echo '<a  href="bbs.php" ">返回</a>';
    }
	echo '</p>';
	exit;
}
?>

<?php echo "用户名：".$_SESSION["username"]."<br>"; ?>

<a href="./offlogin.php">退出登陆</a>


<?php
	if(isset($_POST['submit'])){ 
		if(empty($_POST['title'])){
		    ExitMessage("标题不得为空");
		}
		if(empty($_POST['content'])){
			echo "内容不得为空";
		}


		echo "发帖成功";
		
		$servername = "localhost";
		$username = "bbs3";
		$password = "123456";
		$dbname = "bbs3";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// sql to create table
		$sql = "CREATE TABLE MyGuests (
 		`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		title VARCHAR(30) NOT NULL,
		content VARCHAR(30) NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  		PRIMARY KEY (`id`)
		)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";

		if ($conn->query($sql) === TRUE) {
		  echo "Table MyGuests created successfully";
		} else {
		  echo "Error creating table: " . $conn->error;
		}


		//插入数据
		$title	= $_POST['title'];
		$content	= $_POST['content'];

		$sql = "INSERT INTO MyGuests (title, content, reg_date)
		 VALUES ('$title', '$content', '2038-01-19 03:14:07')";

		if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//查询数据
		$sql = "SELECT title, content FROM MyGuests";
		$result = $conn->query($sql);





	if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo '<br> 标题: <a href="list_son.php">'.$row["title"]." </a> <br>内容: " . $row["content"] . "<br>";

		        echo '管理：<a href="add_user.php">删除</a>  <a href="add_user.php?a=$top">置顶</a>';
		    }
		} else {
		    echo "0 results";
		}
	   

			 
		// if ($result->num_rows > 0) {
		//     // output data of each row
		//     while($row = $result->fetch_assoc()) {
		//         echo '<br> id: <a href="http://baidu.com">'.$row["title"]."</a> - Name: ". $row["title"]. " " . $row["content"] . "<br>";
		//     }
		// } else {
		//     echo "0 results";
		// }
		



		// 删除数据

		// $sql = "DELETE FROM MyGuests WHERE title = 'dd'";
		$sql = "DELETE FROM MyGuests WHERE id = '31'";


		if ($conn->query($sql) === TRUE) {
		  echo "Record deleted successfully";
		} else {
		  echo "Error deleting record: " . $conn->error;
		}



		$conn->close();

	}


?>