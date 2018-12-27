<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>信息查询 - OP人物网</title>
</head>

<body >
<?php 
	ini_set('date.timezone','Asia/Shanghai');
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';

	$sql="select *from people where id= :id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
	
	if(!$query->execute())
	{
		$query->errorinfo()."<br>";
	}
	else
	{
		$result=$query->fetchobject();?>
		<center><h2><?php echo $result->people;?></h2></center><br>
		<?php
		if($result->catelog_id!=0)
		{
			$catelog_id=$result->catelog_id;
			$sql="select * from categories where id=:catelog_id;";
			$query=$db->prepare($sql);
			$query->bindvalue(':catelog_id',$catelog_id,pdo::PARAM_INT);
			$query->execute();
			$catelog=$query->fetchobject()->name;?>
			<center><h2><?php echo $catelog;?></h2></center>
			<?php
		}
		echo "<br>";

		$sql="select * from tags_people  inner join tags  on tags_people.tag_id=tags.id and tags_people.people_id=:id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
		$query->execute();
		while($tag=$query->fetchobject())
		{?>
		<center><?php echo $tag->name;?></center>
		<?php
		}
		echo "<br>";
		echo $result->body;

	}?>

<br><br>
<a href="edit.php?id=<?php echo $result->id;?>">编辑</a>
<a href="delete.php?id=<?php echo $result->id;?>">删除</a>
 <br> <br> <br>
 <center>
 <a href="../">返回首页</a>
<a href="javascript:history.back(-1)">返回上一页</a>
 </center>

<center>
	<h3>评论区</h3>
	<form action="../comment/update.php" method="post">
	<input type="hidden" name='people_id' value="<?php echo $result->id; ?>">
	<label for="title">主题</label>
	<input type="text" name="title" >
	<br>
	<label for="body">内容</label>
	<textarea name="body"></textarea>
	<br>
	<input type="submit" value="提交">
	</form>
	<br>
</center>

 <br> <br> <br>
 <center>
 <a href="../">返回首页</a>
<a href="javascript:history.back(-1)">返回上一页</a>
 </center>

<center>
	<h3>评论区</h3>
	您必须登陆后才能发表评论！
	<br>
	<a href="/login/">去登陆</a>
	<a href="/register/">没有账号？去注册</a>
	<br>
</center>

</body>
</html>