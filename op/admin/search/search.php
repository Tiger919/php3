<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>信息查询 - OP人物网</title>
</head>

<body>
<center><h2>查询结果</h2></center>
<?php 

	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';


	$sql="select *from people where people like :people;";
	$query=$db->prepare($sql);
	$query->bindvalue(':people','%'.$_GET['people'].'%',pdo::PARAM_STR);

	if(!$query->execute())
	{
		echo ($query->errorinfo()).'<br/>';
	}
	else
	{
		$numcount=$query->rowcount();
		if($numcount==0)
		{?><center><?php
			echo "对不起，站内没有{$_GET['people']}这个人物！<br>";?></center><?php
		}
		else
		{
			while($result=$query->fetchobject())
			{
				?>
				<center>
				<a href="show.php?id=<?php echo $result->id; ?>&people=<?php echo $_GET['people'];?>"> <?php echo $result->people; ?></a>
				<br>
				</center>
				<?php
			}
		}?>
	 	<center>
	 	<br><br><br>
	  	<a href="../">返回首页</a>
		<a href="javascript:history.back(-1)">返回上一页</a>
		</center>
	<?php
	}?>
 </body>