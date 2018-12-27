<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>管理员功能 - 新增人物介绍</title>
</head>
<body style="text-align:center">
<h3>新增人物介绍</h3>
<br>
<form action="save.php" method="post" enctype="multipart/form-data">
	<label for="people">人物名称：</label>
	<input type="text" name="people">
	<br>
	<label for="catelog_id">势力分类：</label>
	<select name="catelog_id" >
	<?php
		require_once $_SERVER['DOCUMENT_ROOT']."/inc/db.php";
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
	<label for="tag">标签：</label>
	<input type="text" name="tag">
	<br>
	<label for="pic">人物图片:</label>
	<input type="file" name="pic">
	<br>
	<label for="body">介绍内容</label>
	<textarea name="body"  cols="30" rows="10"></textarea>
	<br><br>
	<input type="submit" value="提交">

</form>
<br>
<a href="../">返回首页</a>
<a href="javascript:history.back(-1)">返回上一页</a>
</body>
</html>