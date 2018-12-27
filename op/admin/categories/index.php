<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分类管理</title>
</head>
<body style="text-align:center">
<h3>分类功能管理</h3>
<br>
	<a href="new.php">新增分类</a>
	<br><br><br>
	所有分类<br>
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";
		$sql="select * from categories";
		$query=$db->prepare($sql);
		$query->execute();
		while($result=$query->fetchobject())
		{
			echo $result->name;?>
			<a href="edit.php?id=<?php echo $result->id;?>">编辑</a>
			<a href="delete.php?id=<?php echo $result->id;?>">删除</a>

			<?php

			echo "<br>";
		}
	?>
	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>
</body>
</html>