<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/redirect_to.php';
	$sql="delete  from categories where id= :id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	if(!$query->execute())
	{
		echo $query->errorinfo()."<br>";
	}
	else
	{
		$sql="update people set catelog_id=0 where catelog_id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
		if(!$query->execute())
		{
			echo $query->errorinfo()."<br>";
		}
		else
		{
			redirect_to("./");
		}
		
	}

 ?>
 </body>
 </html>