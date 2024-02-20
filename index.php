
<link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
 
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->





<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">



  <link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>


<style type="text/css">
	.float 
	{
		float: right;
		width: 500px;
	}

</style>



<?php
session_start();
header("Content-type:text/html;charset=utf-8");

require_once('config.php');


include './templates/search.php';
include './header.inc.php';



if (!file_exists("install"))
{
	include 'install.php';
}

	$liuyan = new Liuyan($servername, $username, $password, $dbname);
	$liuyan->search();
			
			// if(empty($_POST['title'])){
			//    $liuyan->ExitMessage("标题不得为空");
			// }
			// if(empty($_POST['content'])){
			// 	echo "内容不得为空";
			// 	echo '<br><a href="./index.php">返回</a>';
			// 	exit();
			// }
	$liuyan->insert();
	$liuyan->query();
	$liuyan->info();

		if(!empty($_GET['id'])){
				// $liuyan->delete($_GET['id']);
		}
class Liuyan 
{
		private $conn;


			function __construct($servername, $username, $password, $dbname)
			{

					// Create connection
					$this->conn = new mysqli($servername, $username, $password, $dbname);



					// Check connection
					if ($conn->connect_error) {
					  die("d failed: " . $conn->connect_error);
					}

					// $this->table();
 

			}
			function __destruct() 
			{
					$this->conn->close();

			}

		function ExitMessage($message, $url='')
		{
			echo '<p class="message">';
			echo $message;
			echo '<br>';
			if($url){
		    	echo '<a  href="'.$url.'">返回</a>';
		    }else{
		    	echo '<a  href="./index.php" ">返回</a>';
		    }
			echo '</p>';
			exit;
		}
		

	// 建表
	// 	function table()
	// 	{
	// 			$sql = "CREATE TABLE liuyan (
	// 			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	// 		title VARCHAR(30) NOT NULL,
	// 		content VARCHAR(30) NOT NULL,
	// 		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	// 			PRIMARY KEY (`id`)
	// 		)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";
	// 		if ($this->conn->query($sql) === TRUE) {
	// 				  echo "Table yiuYan created successfully";
	// 		}
	// }


		function search()
		{
			if(!empty($_POST['srchtxt'])){
				$a = $_POST['srchtxt'];
				//$sql = "select id, title from liuyan where title ='$a'";
				$sql = "select id, title from liuyan where title LIKE '%$a%'";
				$result = $this->conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				    echo '<a href="list_son.php?id='.$row["id"].'">'.$row["title"]. "</a><br>";
				  }
				} else {
				  echo "没有内容！";
			}
		}
	}
	    //插入数据
		function insert()
		{
			if(!empty($_POST['title'])){
				$title	= $_POST['title'];
				$content	= $_POST['content'];
				$sql = "select * from manage_str";
		    $result = $this->conn->query($sql);
		    // $a = array();
				// if ($result->num_rows > 0) {
				//     // output data of each row
				//     while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				// 			array_push($a, $row["content"]);
				//     }
				// }

				// if (in_array($content, $a)) {
				// 	exit("不允许输入不合法的内容");
				// }
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				    	$pos = strstr($content, $row["content"]);
				    	$posT = strstr($title, $row["content"]);
				    	if ($pos || $posT) {
				    		exit("不允许输入不合法的内容");
				    	}
				    }
				}
				$username = $_SESSION["username"];
				$uid = $_SESSION["id"];
				$currentDateTime = date('Y-m-d H:i:s');

				$sql = "INSERT INTO liuyan (title, content, reg_date, cid, uid)
				 VALUES ('$title', '$content', '$currentDateTime', '$username', '$uid')";
				
				if ($this->conn->query($sql) === TRUE) {
				  echo "留言成功";	
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
		function info() {
				$sql = "select * from information where module_id = '{$_SESSION['id']}' and level = 1";
				$result = $this->conn->query($sql);
				if ($result->num_rows > 0) {
					  echo "提示：<a href='info.php'>有新消息</a><br>";

				}
		}

		function query()
		{
				//查询数据

				$sql = "SELECT id, title, content, love, view, sticky, reply FROM liuyan ORDER BY sticky DESC, love DESC LIMIT 0,10";
				$result = $this->conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
						$a = 1;
						echo '<div class="float container mt-2 a">';
						echo '<div class="card">';
					   echo '<div class=" card-body">';
					    while($row = $result->fetch_assoc()) {
					        // echo '<br> 	: <a href="list_son.php?id='.$row["id"].'&title='.$row["title"].'&content='.$row["content"].'">'.$row["title"]." </a><br>内容: " . $row["content"] . "<br>";
							if ($row['sticky'] == "1")
								{
								  echo '<br>[置顶]';
								}
 echo $a.'.标题: <a href="list_son.php?id='.$row["id"].'">'.$row["title"]." </a><br>内容: " . $row["content"];
					        if (!$row['sticky'] == "1")
					        {

				        ?>
				        <form name="stick" method="post" action="stick_topic.php">
									 <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									 <input type="submit" name="Submit" value="置顶该贴" class="button">
									 将该贴置于顶端.
								</form>
								<?php
							} else {
								?>
								<form name="stick" method="post" action="unstick_topic.php">
									 <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									 <input type="submit" name="Submit" value="取消置顶" class="button">
							</form>
							<?php
						}
						$a++;


						$sql = "SELECT id, name, level from user where id = '".$_SESSION['id']."'";
						$t = $this->conn->query($sql);
						$r = $t->fetch_assoc();
						// print_r($row['level']);
						// if($_SESSION['username'] == ADMIN_USER ||)
				    	  if ($r['level'] == 1)
  							{ 
					        echo '<a href="delete.php?id='.$row["id"].'">删除</a>-';
					        echo '<a href="./edit.php?id='.$row["id"].'">修改</a>';
				      	}
				      		if ($row["love"])
				      		{
					    		echo $row["love"]."赞";

				      		}
					  

				      echo '<a href="./love.php?id='.$row["id"].'">-点赞</a>';
				      echo '浏览量'.$row["view"];
				      echo '回复量'.$row["reply"].'<br>';


				    }
				    echo '</div>';
				    echo '</div>';
				    echo '</div>';
				} else {
				    echo "0 results";
				}
		}



}
include './templates/liuyan.php';
?>	

<a href="./list_father.php">板块列表</a>
<!-- <form method="post" action="./liuyan.php">

	标题：<input type="" name="title"><br />
	内容：<input type="text" name="content"><br />
	<input type="submit" name="submit" />
</form> -->
