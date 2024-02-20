<?php
	include '../config.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select * from information";
	$result = $conn->query($sql);
	echo "管理信息：<br>";
		?>
	<form action="all_info_manage.php" method="get">
		<?php
	while ($row = $result->fetch_assoc()) {
		?>
  <input type="checkbox" name="info[]" value="<?php echo $row['id']; ?>"> <?php echo $row['info']; ?><br>

		<?php
		// echo "<a href='./all_info_manage.php?id={$row['id']}'>删除信息</a><br>";
	}

?>

  <input type="submit" value="删除">

</form>

    <button onclick="getAll(0)">全选</button>
    <button onclick="getAll(1)">全不选</button>
    <button onclick="getAll(2)">反选</button>
     <a href="./info.php">返回</a>
<script>
let input = document.getElementsByTagName("input");
let but = document.getElementsByTagName("button");
function getAll(num)      
{
    for (let i = 0; i < input.length; i++)
    {
        if (num == 0)
        {
            
            input[i].checked = true;
        }
        else if (num == 1)
        {
            input[i].checked = false;
        }
        else if (num == 2)
        {
            input[i].checked = !input[i].checked;
        }
    }

}
</script>
