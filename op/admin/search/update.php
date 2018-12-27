
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

<?php 
	
	require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/inc/redirect_to.php";
	//空判断
	if(empty($_POST['people']))
	{
		echo "人物名称不能为空请重新输入！";?>
		<br>
		<a href="../">返回首页</a>
		<a href="javascript:history.back(-1)">返回上一页</a>
		<?php
		exit();
	}
	if(empty($_POST['body']))
	{
		echo "介绍内容不能为空请重新输入！";?>
		<br>
		<a href="../">返回首页</a>
		<a href="javascript:history.back(-1)">返回上一页</a>
		<?php
		exit();
	}



	if(empty($_FILES["pic"]["name"]))
	{
		$sql="update people set people=:people,body=:body,catelog_id=:catelog_id where id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':people',htmlentities($_POST['people']),pdo::PARAM_STR);
		$query->bindvalue(':body',htmlentities($_POST['body']),pdo::PARAM_STR);
		$query->bindvalue(':catelog_id',$_POST['catelog_id'],pdo::PARAM_INT);
		$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	}
	else
	{
		//图片
		// 允许上传的图片后缀
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["pic"]["name"]);
		$extension = end($temp);     // 获取文件后缀名
		if ((($_FILES["pic"]["type"] == "image/gif")
		|| ($_FILES["pic"]["type"] == "image/jpeg")
		|| ($_FILES["pic"]["type"] == "image/jpg")
		|| ($_FILES["pic"]["type"] == "image/pjpeg")
		|| ($_FILES["pic"]["type"] == "image/x-png")
		|| ($_FILES["pic"]["type"] == "image/png"))
		&& ($_FILES["pic"]["size"] < 204800)   // 小于 200 kb
		&& in_array($extension, $allowedExts))
		{
		    $dest_path="/uploads/post-".rand().".".$extension;
		    $dest=$_SERVER['DOCUMENT_ROOT'].$dest_path;
		    move_uploaded_file($_FILES["pic"]["tmp_name"], $dest);
		}
		else
		{
		    echo "非法的文件格式";
		}
		//



		$sql="update people set people=:people,body=:body,catelog_id=:catelog_id,pic=:dest_path where id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':people',htmlentities($_POST['people']),pdo::PARAM_STR);
		$query->bindvalue(':body',htmlentities($_POST['body']),pdo::PARAM_STR);
		$query->bindvalue(':catelog_id',$_POST['catelog_id'],pdo::PARAM_INT);
		$query->bindvalue(':dest_path',$dest_path,pdo::PARAM_STR);
		$query->bindvalue(':id',$_POST['id'],pdo::PARAM_INT);
	}

	if(!$query->execute())
	{
		echo"更新编辑错误！<br>";
		$query->errorinfo();
		exit();
	}
	else
	{
		if($_POST['tag']!=NULL)
		{
		$sql="select * from tags where name=:name;";
		$query=$db->prepare($sql);
		$query->bindvalue(':name',$_POST['tag'],pdo::PARAM_STR);
		$query->execute();
		if($query->rowcount()==0)
		{
			$sql="insert into tags(name) values(:name);";
			$query=$db->prepare($sql);
			$query->bindvalue(':name',$_POST['tag'],pdo::PARAM_STR);
			$query->execute();
		}
		$sql="select * from tags where name=:name;";
		$query=$db->prepare($sql);
		$query->bindvalue(':name',$_POST['tag'],pdo::PARAM_STR);
		$query->execute();
		$tag_id=$query->fetchobject();
		$sql="insert into tags_people (people_id,tag_id) values(:people_id,:tag_id);";
		$query=$db->prepare($sql);
		$query->bindvalue(':people_id',$_POST['id'],pdo::PARAM_INT);
		$query->bindvalue(':tag_id',$tag_id->id,pdo::PARAM_INT);
		if(!$query->execute())
		{
			echo $query->errorinfo();
		}
	}

		redirect_to("./show.php?id={$_POST['id']}");
	}
 ?>





 </body>
</html>