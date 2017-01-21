<?php 
		$id=$_GET['id'];
		//连接数据库
		$link=@mysql_connect('localhost','root','')or die(mysql_error());
		mysql_select_db('data');
		mysql_query('set names utf8');

		$sql="delete from man where id=$id";
		if(mysql_query($sql)){
			header('location:admin.php');
		}else{
			echo "删除失败";
		}



?>