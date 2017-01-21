<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加用户</title>
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript">
		function check(){
			//姓名不能为空
			var name=document.getElementById('name');
			if(name.value==''){
				alert('姓名不能为空');
				name.focus(); //获得焦点
				return false;
			}
			//验证性别
			 var sex=document.getElementById('sex');
			if(sex.value==''){
				alert('性别不能为空');
				sex.focus();
				return false;
			}else if(sex.value!='男' && sex.value!='女'){
				alert('请正确输入性别（男/女）');
				sex.focus();
				return false;
			}

			//验证成绩
			var score=document.getElementById('score');
			if(score.value==''){
				alert('成绩不能为空');
				score.focus();
				return false;
			}else if(score.value<0 || score.value>100){
				alert('请正确输入成绩(0~100)');
				score.focus();
				return false;
			}


		}
	</script>
</head>
<body>
<?php 
	if (isset($_POST['button'])) {
		//获取提交的数据
		$name=$_POST['name'];
		$sex=$_POST['sex'];
		$score=$_POST['score'];
		
		//链接数据库
		$link=@mysql_connect('localhost','root','')or die(mysql_error());
		mysql_select_db('data');
		mysql_query('set names utf8');
		//拼接一个sql语句
		$sql="insert into man values (Null,'$name','$sex','$score')";
		if(mysql_query($sql)){
			echo '输入成功！';
		}else{
			echo '插入失败!';
		}
	}


 ?>


<form name="form1" method="post" action="" onsubmit="return check()">
	<table>
		<tr>
			<td colspan="2">添加学生</td>
		</tr>
		<tr>
			<td>姓名</td>
			<td><input type="text" name="name" id="name"></td>
		</tr>
		<tr>
			<td>性别</td>
			<td><input type="text" name="sex" id="sex"></td>
		</tr>
		<tr>
			<td>成绩</td>
			<td><input type="text" name="score" id="score"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="添加" name="button">
				<input type="button" value="返回" onclick="location.href='admin.php'">
			</td>
		</tr>
	</table>
</form>
</body>
</html>