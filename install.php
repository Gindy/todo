<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if (file_exists("install"))
{
	echo "程序已安装成功！";
	exit();
}
$sql = "CREATE TABLE liuyan (
				`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			title VARCHAR(30) NOT NULL,
			content VARCHAR(30) NOT NULL,
			sticky int(10) not null,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`id`)
			)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0";
if ($conn->query($sql) === TRUE) {
	echo "Table yiuYan created successfully";
	$myfile = fopen("install", "w") or die("Unable to open file!");
	$txt = "install\n";
	fwrite($myfile, $txt);
	echo "程序已安装成功！";
}

?>