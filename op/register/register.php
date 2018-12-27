<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册 - OP人物网</title>
  <style>
	
  </style>

</head>

<body>
<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';

	$sql="select *from login where account = :account;";
	$query=$db->prepare($sql);
	$query->bindvalue(':account',$_POST['account']);
	if(!$query->execute())
	{
		echo $query->errorinfo();
	}
	else
	{
		$result=$query->fetchobject();
		//查询数据库中的账号
		
		if(!$result)
		{
			if($_POST['password']==$_POST['rpassword'])
			{
				$sql="insert into login (account,password,admin) values(:account,:password,:admin);";
				$query=$db->prepare($sql);
				$query->bindvalue(':account',$_POST['account']);
				$query->bindvalue(':password',$_POST['password']);
				$query->bindvalue(':admin',$_POST['admin']);
				if(!$query->execute())
				{
					echo $query->errorinfo();
					echo "<br/>注册失败！";
				}
				else
				{
					echo "注册成功！";
				}?>
				<br>
				<a href="../login">去登陆</a>
				<a href="../">返回首页</a>
				<?php

			}
			else
			{
				echo "注册失败！两次输入的密码不一致!";?>
				<br>
				<a href="javascript:history.back(-1)">重新注册</a>
				<?php

			}
		}
		else
		{
			echo "注册失败！账号已存在!";?>
			<br>
			<a href="javascript:history.back(-1)">重新注册</a>
			<?php
		}
	}
	






 ?> 
 </body>
