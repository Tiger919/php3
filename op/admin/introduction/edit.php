<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>服务指南 - OP人物网</title>
</head>

<body style="text-align:center">
<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
	$sql="select * from introduction where id=:id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
	$query->execute();
	$result=$query->fetchobject();
?>
	<form action="update.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<input type="hidden" name="name" value="<?php echo $result->name;?>">
	<label for="title">介绍标题</label>
	<input type="text" name="title" value="<?php echo $result->title;?>">
	<br>
	<label for="body">介绍内容</label>
	<textarea name="body"  cols="30" rows="10"><?php echo $result->body;?>
	</textarea>
	<br>
	<input type="submit" value="提交">
	</form>
	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>
</body>
</html>