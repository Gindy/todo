<?php
require_once('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$page=isset($_GET['page'])?intval($_GET['page']):1;        //这句就是获取page=18中的page的值，假如不存在page，那么页数就是1。

			$num=10;         //每页显示10条数据

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

			 

			       $show=($i!=$page)?"<a href='newliuyan2.php?page=".$i."'>$i</a>":"<b>$i</b>";

			       Echo $show." ";

			}
