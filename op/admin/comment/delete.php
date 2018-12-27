<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>信息查询 - OP人物网</title>
</head>
<body>
<?php 
	ini_set('date.timezone','Asia/Shanghai');
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';

	$sql="select * from comments where id =:id;";
	$query=$db->prepare($sql);
	$query->bindvalue(':id',$_GET['id'],pdo::PARAM_INT);
	$query->execute();
	$comment=$query->fetchobject();
 ?>
 	<li>	
	<h4><?php echo $comment->title; ?></h4>
	<span><?php echo date('Y-m-d',strtotime($comment->created_at)); ?></span>
	<p><?php echo $comment->body;?> </p>
	</li>
	<form action="destory.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<input type="hidden" name="people_id" value="<?php echo $_GET['people_id']?>">
	<br><br>
	是否删除该条评论？
	<input type="submit" value="确定">
	</form>
	<a href="../">返回首页</a>
	<a href="javascript:history.back(-1)">返回上一页</a>


</body>
</html>
