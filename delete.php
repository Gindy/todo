<?php

include 'config.php'; 








// $conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to delete a record
  $sql = "DELETE FROM liuyan WHERE id='$id'";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Record deleted successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
// $sql = "DELETE FROM liuyan WHERE id='$id'";
// if ($conn->query($sql) === TRUE) {
// 	  echo "删除成功";
// } else {
//   echo "Error deleting record: " . $conn->error;
// }
?>
<a href="./index.php">返回</a>