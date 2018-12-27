<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title> 所有人物- OP人物网</title>
</head>

<body style="text-align:center">
	<h3>OP人物录</h3>
	<br><br><br>
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";

		$sql="select * from people;";
		$query=$db->prepare($sql);
		$query->execute();

		while($result=$query->fetchobject())
		{?>
			<a href="../search/show.php?id=<?php echo $result->id;?>"><?php echo $result->people;?></a>
			<br>
		<?php
		}

	 ?>
<br> <br> <br>
<center>
<a href="../">返回首页</a>
<a href="javascript:history.back(-1)">返回上一页</a>
</center>


</body>