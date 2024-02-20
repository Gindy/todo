
<style type="text/css">
	.float 
	{
		float: right;
		width: 500px;
	}
	#scbar_txt {
	width: 400px;
	height: 18px;
	border: 1px solid #cfdee3;
	outline: none;
	padding: 5px 6px;
}
#scbar_btn {
	display: block;
	margin: 0 0 0 8px;
	padding: 0 0 0 2px;
	border: none;
	background: #2B7ACD;
	font-size: 18px;
	line-height: 28px;
</style>


<?php
session_start();
header("Content-type:text/html;charset=utf-8");

include 'config.php';




$liuyan = new Liuyan($servername, $username, $password, $dbname);

$liuyan->search();


		// if(!empty($_GET['id'])){
		// 		$liuyan->delete($_GET['id']);
		// }
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
	
		function search()
		{
			$a = $_POST['srchtxt'];
			$sql = "select id, title from liuyan where title ='$a'";
			$result = $this->conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    echo '<a href="list_son.php?id='.$row["id"].'">'.$row["title"]. "</a><br>";
			  }
			} else {
			  echo "没有内容！!";
			}
		}
	    //插入数据
		
}
?>	
<!-- <form method="post" action="./liuyan.php">

	标题：<input type="" name="title"><br />
	内容：<input type="text" name="content"><br />
	<input type="submit" name="submit" />
</form> -->

</style>
<form method="post" action="./test.php">
<input id="scbar_txt" type="text" name="srchtxt" placeholder="请输入搜索内容" autocomplete="off" speech="" x-webkit-speech="">
<button id="scbar_btn" type="submit">搜索</button>
</form>