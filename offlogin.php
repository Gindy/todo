<?php  
header("Content-type:text/html;charset=utf-8");

  session_start();
  //清空SESSION
  $_SESSION = array();
  session_unset();

  //清空SESSION
  session_destroy();
  echo "退出成功~";
  ?>
<a href="../bbs/index.php">返回首页</a>