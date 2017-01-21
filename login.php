<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登录</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	<?php 
		if(isset($_POST['button'])){
			$username=$_POST['username'];
			$pwd=$_POST['pwd'];

			//连接数据库
			$link=@mysql_connect('localhost','root','')or die('数据库连接失败');
			mysql_select_db('data',$link);
			mysql_query('set names utf8');

			$sql="select * from `user` where username='$username' and `password`='$pwd'";
			$rs=mysql_query($sql);
			//获得结果集的记录数
			if(mysql_num_rows($rs)==1){
				//echo '登陆成功';
				//跳转页面，用  header('location:url地址')
				header('location:showmans.php');
			}else {
				echo '登陆失败';
			}


		}


	 ?>


	<form action="" method="post" name="form1">
		<table>
			<tr>
				<td>用户名：</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>密&nbsp;&nbsp;码：</td>
				<td><input type="password" name="pwd"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="button" value="提交">
				</td>
			</tr>
		</table>
		
		
	</form>
</body>
</html>