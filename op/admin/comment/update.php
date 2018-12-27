<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/redirect_to.php';

 	ini_set('date.timezone','Asia/Shanghai');
	
	$sql="insert into comments (title,body,people_id,created_at) values(:title,:body,:people_id,:created_at);";
	$query=$db->prepare($sql);
	$query->bindvalue(':title',htmlentities($_POST['title']));
	$query->bindvalue(':body',htmlentities($_POST['body']));
	$query->bindvalue(':people_id',$_POST['people_id'],pdo::PARAM_INT);
	$query->bindvalue(':created_at',date('Y-m-d H:i:s'));
	if(!$query->execute())
	{
		echo "发表评论失败<br>";
		echo $query->errorinfo()."<br>";
		?>
		<a href="javascript:history.back(-1)">重新发表</a>
		<?php

	}
	else
	{
		redirect_to("../search/show.php?id={$_POST['people_id']}");
	}

 ?>