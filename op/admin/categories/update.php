<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - OP人物网</title>
</head>

<body >
<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/redirect_to.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';

	$sql="update categories set name=:name where id=:id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':name',$_POST['name'],pdo::PARAM_STR);
	$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	if(!$query->execute())
	{
		echo "更新编辑错误！<br>";
		echo $query->errorinfo()."<br>";
	}
	else
	{
		redirect_to("./");
	}
	
 ?>
 </body>
 