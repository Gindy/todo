
<?php
include './config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "select * from info";

$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $row['title']?></title>
</head>
<body>

</body>
</html>