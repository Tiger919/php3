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
		$people=$query->fetchobject();?>
		<center><h2><?php echo $people->people;?></h2></center><br>
		<?php
		if($people->catelog_id!=0)
		{
			$catelog_id=$people->catelog_id;
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
		<center><?php echo $tag->name;?>
		</center>
		<?php
		}
		echo "<br>";?>
		<img src="<?php echo $people->pic;?>"></img>
		<br>
		<?php
		echo $people->body;

	}?>

<br><br>
<a href="edit.php?id=<?php echo $people->id;?>">编辑</a>
<a href="delete.php?id=<?php echo $people->id;?>">删除</a>
 <br> <br> <br>
 <center>
 <a href="../">返回首页</a>
<a href="javascript:history.back(-1)">返回上一页</a>
 </center>

<center>
	<h3>评论区</h3>
	<form action="../comment/update.php" method="post">
	<input type="hidden" name='people_id' value="<?php echo $people->id; ?>">
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

<ol>
	<?php  
		$sql="select *from comments where people_id=:people_id;";
		$query=$db->prepare($sql);
		$query->bindvalue(':people_id',$people->id,pdo::PARAM_INT);
		if(!$query->execute())
		{
			echo "评论显示失败！";
			echo $query->errorinfo()."<br>";
		}
		else
		{
			while($comment=$query->fetchobject())
			{?>

				<li>	
				<h4><?php echo $comment->title; ?></h4>
				<span><?php echo date('Y-m-d',strtotime($comment->created_at)); ?></span>
				<p><?php echo $comment->body;?> </p>
				<p><a href="../comment/delete.php?id=<?php echo $comment->id;?>&people_id=<?php echo $_GET['id'];?>">删除</a></p>
				</li>
			<?php 
			}	
		}	
	?>	
</ol>
</body>
</html>


