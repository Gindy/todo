
<?php
header("Content-type:text/html;charset=utf-8");
$servername = "localhost";
$username = "liuyan";
$password = "123456";
$dbname = "liuyan";
//MySQL字符集
$dbcharset = 'utf8';
//系统默认字符集
$charset = 'utf-8';
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, title, content FROM liuyan";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {

?>
<form method="post" action="test2.php">
	<input type="checkbox" name="vehicle[]" value="<?php echo $row['title']?>"><?php echo $row['title']?><br>


<?php
	}
	?>
	<input type="submit" value="Submit">
</form>
<?php

	if(!empty($_POST['vehicle'])){
		$vehicles = $_POST['vehicle'];
		// 将数组字符化
		// $vehicle = implode(',', $vehicles);
		// print_r($_POST['vehicle']);
		// print_r($vehicle);
		foreach($vehicles as $value)
		{
			// $sql = 'insert into liuyan(title) values("'.$value.'")';
			// $result = $conn->query($sql);
			// print_r($sql);
			$sql = "delete from liuyan where title = '$value'";
			$result = $conn->query($sql);
			print_r($sql);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap5 实例</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
	<div class"card">
		<div class="float card-body">
		123
		</div>
	</div>
</div>
</body>
</html>



