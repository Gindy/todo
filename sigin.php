<?php
session_start(); //启动Session
header("Content-type:text/html;charset=utf-8");
	if(isset($_POST['submit'])){ 
		if (empty($_POST['name']))
			{
				echo "请输入账号";
			}
		if (empty($_POST['password']))
		{
			echo "<br>请输入密码";
			exit();
		}

		include 'config.php'; 
		$conn = new mysqli($servername, $username, $password, $dbname);


		$name	= $_POST['name'];
		$password	= md5($_POST['password']);

		$sql = "SELECT name from user WHERE name = '$name'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) {
			echo "该用户已经存在！点击返回重新注册";
			exit();
		  }
		$_SESSION["username"] = $_POST['name'];

		$sql = "INSERT INTO user (name, password, reg_date)
		 VALUES ('$name', '$password', '2038-01-19 03:14:07')";
		if ($conn->query($sql) === TRUE) {

	 		$sql = "SELECT id, name from user WHERE name = '$name'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$_SESSION["id"] = $row['id'];
			echo $row['id'];
			
			echo "账号注册成功";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		exit();
		$conn->close();

	}




?>
<form method="post" action="./sigin.php">
  <div class="mb-3 mt-3">
    账号：
    <input type="title" class="form-control" id="name" placeholder="输入 账号" name="name">
  </div>
  <div class="mb-3">
    密码：
	<input class="form-control" placeholder="输入 密码" rows="5" id="password" name="password"></input>
</div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<a href="../bbs/index.php">返回首页</a>