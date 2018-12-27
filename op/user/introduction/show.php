<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>服务指南 - OP人物网</title>
</head>

<body style="text-align:center">

<?php 

	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';

	$sql="select * from introduction where name = :name;";
	$query=$db->prepare($sql);
	$query->bindvalue(':name',$_GET['name'],pdo::PARAM_STR);
	if(!$query->execute())
	{
		echo $query->errorinfo()."<br>";
	}
	else
	{
		$result=$query->fetchobject();
		?>
		<p><?php echo $result->title;?></p>
		<p><?php echo $result->body;?></p>
		<?php
	}?>
	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>
</body>	
</html>