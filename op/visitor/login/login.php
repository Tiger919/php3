<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>登陆 - OP人物网</title>
  <style >
	
  </style>

</head>

<body>
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'].'/inc/db.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/inc/redirect_to.php';

		$sql="select *from login where account = :account and password = :password;";
		$query=$db->prepare($sql);
		$query->bindvalue(':account',$_POST['account']);
		$query->bindvalue(':password',$_POST['password']);
		
		if(!$query->execute())
		{
			echo $query->errorinfo();

		}
		else
		{
			if(!$result=$query->fetchobject())
			{
				echo "登陆失败！账号密码错误！<br>";?>
				<a href="/login">重新登陆</a>
				<a href="/register">没有账号？去注册</a>
			<?php
			}
			else
			{
				session_start();
				$_SESSION['account']=$result->account;
				if($result->admin==1)  //重定向至管理员
				{
					redirect_to("/admin/");
				}
				else  //重定向至用户
				{
					redirect_to("/user/");
				}
	
			}
		}
	 ?>
</body>
</html>