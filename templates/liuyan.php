<style type="text/css">
  .input 
  {
    width: 300px;
  }
.textarea
{
  width: 300;
}
 
</style>

<form method="post" action="./index.php">
  <div class="mb-3 mt-3">
    标题：
    <input type="title" class="form-control input" id="title" placeholder="输入 标题" name="title">
  </div>
  <div class="mb-3">
    内容:
	<textarea class="form-control textarea" placeholder="输入 内容" rows="5" id="comment" name="content"></textarea>



  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<?php
 if($_SESSION["username"])
 {
    echo '你好！'."<a href='./member.php?id={$_SESSION["id"]}'>{$_SESSION["username"]}</a>-"."<a href='./offlogin.php'>退出登陆</a>";

 }
 else
 {
  echo '<a href="sigin.php">注册-</a>';
  echo '<a href="login.php">登陆</a>';

 }
  include 'config.php';
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql="select count(*) as num from user";
  $result=$conn->query($sql);
  $row=$result->fetch_array();
  echo "会员数：".$row['num']; 
  $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
  $result=$conn->query($sql);
  $row = $result->fetch_assoc();
  echo "-新会员：".$row['name'];
?>
