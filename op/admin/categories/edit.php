<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>管理员功能 - 分类编辑</title>
</head>
<body style="text-align:center">
	<?php
		require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";

		$sql="select * from categories where id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
		$query->execute();
		$result=$query->fetchobject();
	?>
	<form action="update.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<label for="name">分类名称</label>
	<input type="text" name="name" >
	<br>
	<input type="submit" value="提交">
	</form>
	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>
	
</body>
</html>