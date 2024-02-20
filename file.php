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





$sql = "select * from liuyan";
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

$sql = "select * from liuyan limit $offset,$num";
$info=$conn->query($sql);   //获取相应页数所需要显示的数据

While($it=$info->fetch_assoc()){

       echo $it['title']."<br />";

}                                                              //显示数据

 

For($i=1;$i<=$pagenum;$i++){

 

       $show=($i!=$page)?"<a href='file.php?page=".$i."'>$i</a>":"<b>$i</b>";

       Echo $show." ";

}

/*显示分页信息，假如是当页则显示粗体的数字，其余的页数则为超连接，假如当前为第三页则显示如下

1 2 3 4 5 6

*/

?>