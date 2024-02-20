

<link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
 
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<?php

header("Content-type:text/html;charset=utf-8");
	include 'config.php';
	include 'common.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$id = $_GET['id'];
	$sql = "SELECT id, title, content FROM liuyan where id = '$id'";
	$result = $conn->query($sql);
	// output data of each row
	$row = mysqli_fetch_array($result);
	$title = $row['title'];
	$content = $row['content'];

	if(isset($_POST['submit'])){ 
		if(empty($_POST['title'])){
		   ExitMessage("标题不得为空");
		}
		if(empty($_POST['content'])){
			echo "内容不得为空";


			echo "<br><a href='./edit.php?id={$row['id']}'>返回</a>";
			exit();
		}
		if (isset($_POST['submit'])) {

			$title = $_POST["title"];
			$content = $_POST["content"];
			$sql = "UPDATE liuyan SET title='$title', content='$content' WHERE id='$id'";
			if ($conn->query($sql) === TRUE) {
				  echo "更改成功";
				} else {
				  echo "Error updating record: " . $conn->error;
				}
			}
	}
	$conn->close();
	 

?>	
<form method="post" action="./edit.php?id=<?php echo $id	?>">
  <div class="mb-3 mt-3">
    标题：
    <input type="title" class="form-control" id="title" value="<?php echo $title ?>" placeholder="" name="title">
  </div>
  <div class="mb-3">
    内容:
	<textarea class="form-control" value="" placeholder="" rows="5" id="comment" name="content"><?php echo $content ?></textarea>

  <button type="submit" name="submit" class="btn btn-primary">提交</button>
</form>

<a href="./index.php">返回首页</a>

