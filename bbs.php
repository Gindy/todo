
<?php 
	header("Content-type:text/html;charset=utf-8");
	echo $_SESSION["username"]; 
	?>

发帖：
<form method="post" action="add_user.php">
	标题：<input type="" name="title"><br />
	内容：<input type="text" name="content"><br />
	<input type="submit" name="submit" />
</form>

登陆：
<form method="post" action="login.php">
	账号：<input type="" name="name"><br />
	密码：<input type="text" name="password"><br />
	<input type="submit" name="submit" />
</form>



