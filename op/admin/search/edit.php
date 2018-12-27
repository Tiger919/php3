<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>信息查询 - OP人物网</title>
</head>

<body style="text-align:center">
<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
	$sql="select * from people where id=:id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
	$query->execute();
	$people=$query->fetchobject();
?>
	<form action="update.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<label for="people">人物名称：</label>
	<input type="text" name="people" value="<?php echo $people->people;?>">
	<br>
	<label for="catelog_id">势力分类：</label>
	<select name="catelog_id" >
	<?php
		$sql="select * from categories ;";
		$query=$db->prepare($sql);
		$query->execute();
		while($catelog=$query->fetchobject())
		{?>
			<option value="<?php echo $catelog->id;?>"><?php echo $catelog->name;?></option>
		<?php
		}
	?>
	</select>
	
	<br>
	
	<?php 
		$sql="select * from tags inner join tags_people on tags_people.people_id=:people_id and tags.id=tags_people.tag_id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':people_id',$_GET['id'],pdo::PARAM_INT);
		$query->execute();
		while($tag=$query->fetchobject())
		{?>
			<input type="text"  value="<?php echo $tag->name?>">
			<a href="">删除</a>
		<?php
		}
	 ?>
 	<br>
 	<label for="tag">新增标签</label>
 	<input type="text" name="tag">
 	<br>
	<label for="pic">人物图片:</label>
	<input type="file" name="pic">
	<br>
	<label for="body">介绍内容</label>
	<textarea name="body"  cols="30" rows="10"><?php echo $people->body;?>
	</textarea>
	<br>
	<input type="submit" value="提交">
	</form>


	<br>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>
</body>
</html>