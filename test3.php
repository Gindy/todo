<?php
namespace MyProject {

	class a {
		public $a = 1;
	}
	// echo stripos("caabc", "c");
	$arr = array("毛泽东", "习近平");
	if (in_array("毛泽东", $arr)) {
		exit("错误");
	}

}
// namespace AnotherProject {

// 	class a {
// 		public $a = 2;
// 	}
// 	$b = new a();
// 	echo $b->a;
// }
?>