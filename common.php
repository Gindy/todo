<?php
function ExitMessage($message, $url='')
	{
		echo '<p class="message">';
		echo $message;
		echo '<br>';
		if($url){
	    	echo '<a  href="'.$url.'">返回</a>';
	    }else{
	    	echo '<a  href="./index.php" ">返回</a>';
	    }
		echo '</p>';
		exit;
	}
?>