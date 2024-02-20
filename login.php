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
		$result = $conn->query("SELECT * FROM user WHERE name='".$name."' LIMIT 1");
		// while ($row = $result->fetch_assoc())
		// {
		// 	echo $row['name'];
		// 	echo $row['password'];
		// }
		$row = $result->fetch_assoc();
		if (($result->num_rows > 0) && ($row["password"] == $password)) {
			echo "登陆成功";
			$_SESSION["username"] = $_POST['name'];
			$_SESSION["id"] = $row['id'];
			echo $_SESSION["id"];
			echo $row['id'];	
			echo $row['name'];
			echo $row['password'];
		} else if (!$result->num_rows)
		{
			echo "没有这个账号！";
		}
		else if ($row["password"] != $password)
		{
			echo "密码不正确！";
		}
		else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		exit();
		$conn->close();

	}




?>
<form method="post" action="./login.php">
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
