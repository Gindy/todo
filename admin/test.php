
<?php  
    function format_date($dateStr) {  
    $limit = strtotime(date('Y-m-d H:i:s'),time()) - strtotime($dateStr);  
    $r = "";  
    echo time();
    if($limit < 60) {  
    $r = '刚刚';  
    } elseif($limit >= 60 && $limit 
    < 3600) {  
    $r = floor($limit / 60) . '分钟前';  
    } elseif($limit >= 3600 && $limit 
    < 86400) {  
    $r = floor($limit / 3600) . '小时前';  
    } elseif($limit >= 86400 && $limit 
    < 2592000) {  
    $r = floor($limit / 86400) . '天前';  
    } elseif($limit >= 2592000 && $limit 
    < 31104000) {  
    $r = floor($limit / 2592000) . '个月前';  
    } else {  
    $r = "很久前";  
    }  
    return $r . "（" . $dateStr . "）";  
    }  
    echo "发表于：" . format_date
    ("2024-2-15 23:40:33");

    echo "<br>";
    echo date("Y-m-d H:i");


?>  
