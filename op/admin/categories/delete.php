<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>删除 - 分类管理</title>
</head>
<body style="text-align:center">
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";
		$sql="select name from categories where id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
		$query->execute();
		$result=$query->fetchobject();
	 ?>

 	<form action="destory.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<input type="text" name="name" value="<?php echo $result->name;?>">
	<br><br>
	是否删除该分类？
	<input type="submit" value="确定">
	</form>
	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>

</body>
</html>