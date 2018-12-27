<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>信息查询 - OP人物网</title>
</head>

<body>
<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/redirect_to.php';
	$sql="delete  from comments where id= :id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	if(!$query->execute())
	{
		echo $query->errorinfo()."<br>";
	}
	else
	{
		redirect_to("../search/show.php?id={$_POST['people_id']}");
	}
	
	


 ?>
 </body>