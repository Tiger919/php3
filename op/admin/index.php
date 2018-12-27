<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - OP人物网</title>
</head>

<body>
	<center><h1>OP人物网<h1></center>
	<br/>


	<center>
	<?php 
		session_start();
		echo "欢迎管理员".$_SESSION['account']."!";
	 ?>
	</center>
	 <br>
	 <center>
	 <a href="/login">切换账号</a>
	 <a href="/register">注册</a>
	</center>
	<br>

	
	<center>
	<a href="./introduction/">网站介绍</a>
	<a href="./server/">服务指南</a>
	<a href="./search/">人物查询</a>
	<a href="./all/">所有人物</a>
	<a href="./profile/">网站概况</a>
	<a href="./tel/">联系方式</a>
	</center>
	<br>
	<center><h5>管理员功能</h5>
	<a href="./new/new.php">新增人物介绍</a><br>
	<a href="./categories/">分类功能管理</a>


	</center>




	

	

</body>