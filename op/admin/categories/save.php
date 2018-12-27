<?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/inc/redirect_to.php";

	$sql="insert into categories(name) values(:name);";
	$query=$db->prepare($sql);
	$query->bindvalue(':name',$_POST['people'],pdo::PARAM_STR);
	if(!$query->execute())
	{
		echo "新增保存错误！";
		$query->errorinfo();
		exit();
	} 
	else
	{
		redirect_to("./");
	}




 ?>	

