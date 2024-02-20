<?php




include '../config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);
delete($_GET['id']);
function delete($id)
{
if ($id)
{
	$sql = "DELETE FROM liuyan WHERE id='$id'";
	global $conn;
	$result = $conn->query($sql);
	if ($result === TRUE) {
		  echo "删除成功<br>";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}
   }
}



?>
管理帖子：
<?php


/*

Author:默默

Date :2006-12-03

*/

$page=isset($_GET['page'])?intval($_GET['page']):1;        //这句就是获取page=18中的page的值，假如不存在page，那么页数就是1。

$num=10;         //每页显示10条数据


$conn = new mysqli("localhost", "liuyan", "123456", "liuyan");




/*

首先咱们要获取数据库中到底有多少数据，才能判断具体要分多少页，总页数 具体的公式就是

总数据数 除以 每页显示的条数，有余进一 。

也就是说10/3=3.3333=4 有余数就要进一。

*/





$sql = "select * from liuyan, content";
$result = $conn->query($sql);
$total = $result->num_rows;




// $total=mysql_num_rows(mysql_query()); //查询数据的总数total

$pagenum=ceil($total/$num);      //获得总页数 pagenum

//假如传入的页数参数apge 大于总页数 pagenum，则显示错误信息

If($page>$pagenum || $page == 0){

       Echo "Error : Can Not Found The page .";

       Exit;

}

$offset=($page-1)*$num;         //获取limit的第一个参数的值 offset ，假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。             (传入的页数-1) * 每页的数据 得到limit第一个参数的值

$sql = "select * from liuyan,content limit $offset,$num";
$info=$conn->query($sql);   //获取相应页数所需要显示的数据
$a = 1;
While($it=$info->fetch_assoc()){

       echo "<br />".$a.".".$it['title'];
       echo '<a href="index.php?id='.$it["id"].'">删除</a>-';
       echo '<a href="../edit.php?id='.$it["id"].'">修改</a>';
	   $a++;
}                                                              //显示数据


       echo "<br>";

For($i=1;$i<=$pagenum;$i++){

 

       $show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";

       Echo $show." ";

}

/*显示分页信息，假如是当页则显示粗体的数字，其余的页数则为超连接，假如当前为第三页则显示如下

1 2 3 4 5 6

*/

echo '<br><a href="./manage.php">管理员</a>';
echo '<br><a href="./user.php">管理用户</a>';
echo '<br><a href="./web_set.php">更改网站名字</a>';
echo '<br><a href="./manage_list.php">管理板块</a>';
echo '<br><a href="./info.php">发送信息</a>';
echo '<br><a href="./manage_str.php">管理不合法的内容</a>';
?>



<?php
/*
$sql = "SELECT id, title, content FROM liuyan ORDER BY sticky DESC LIMIT 0,10";
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	echo "<br>".$row["title"];
	        echo '<a href="admin.php?id='.$row["id"].'">删除</a>-';
	        echo '<a href="./edit.php?id='.$row["id"].'">修改</a>';
	    }
	}
	*/
?>