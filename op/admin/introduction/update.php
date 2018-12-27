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

	$sql="update introduction set title=:title,body=:body where id=:id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':title',htmlentities($_POST['title']));
	$query->bindvalue(':body',htmlentities($_POST['body']));
	$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	if(!$query->execute())
	{
		echo "更新编辑错误！<br>";
		echo $query->errorinfo()."<br>";
	}
	else
	{
		redirect_to("./show.php?name={$_POST['name']}");
	}
	
 ?>
 </body>
 