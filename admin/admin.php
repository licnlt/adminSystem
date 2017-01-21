<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户表</title>
	<link rel="stylesheet" href="../css/style.css">
	<script>
		function jump(id){
			if (confirm('确认删除？')) {
				location.href='del.php?id='+id;
			}else{
				return false;
			}
		}
	</script>
</head>
<body>
	<?php
	//链接数据库
		$link=@mysql_connect('localhost','root','') or die('数据库连接失败');
		mysql_select_db('data') or die('数据库选择失败');
		mysql_query('set names utf8');
	//定义页面大小
		$pagesize=10;
	//求总记录数
		$rs=mysql_query('select count(*) from man');
		$rows=mysql_fetch_row($rs);  //将资源匹配成索引数组
		$recordcount=$rows[0];   //总记录数  为46

	//求总页数
		$pagecount=ceil($recordcount / $pagesize);
	//获得当前传递的页码
		$pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
		// echo $pageno;
		//求当前页的起始位置
		$startno=($pageno-1)*$pagesize;

		//获取当前页的内容(order by id desc 通过id降序排序)
		$sql="select * from man order by id desc limit $startno,$pagesize ";
		$rs=mysql_query($sql);	
	?>
	
	<a href="add.php">添加学生</a>

	<table>
		<th>序号</th>
		<th>姓名</th>
		<th>性别</th>
		<th>成绩</th>
		<th>修改</th>
		<th>删除</th>
		<?php 
			while($rows=mysql_fetch_assoc($rs)){
				echo '<tr>';
				echo '<td>'.$rows['id'].'</td>';
				echo '<td>'.$rows['name'].'</td>';
				echo '<td>'.$rows['sex'].'</td>';
				echo '<td>'.$rows['score'].'</td>';
				echo '<td><input type="button" value="修改" onclick="location.href=\'modify.php?id='.$rows['id'].'\'"></td>';
				echo '<td><input type="button" id="button2" value="删除" onclick="jump('.$rows['id'].')"></td>';
				echo '</tr>';
			}
		 ?>
	</table>

	<table>
		<tr>
			<td>
				<a href="admin.php?pageno=1">首页</a>
				<a href="admin.php?pageno=<?php echo $pageno==1?1:($pageno-1) ?>">上一页</a> 
				<?php 		
					for ($i=1;$i<=$pagecount;$i++) {
						echo '<a href="admin.php?pageno='.$i.'">'.$i.'</a>&nbsp';
					}
				 ?>
				 <a href="admin.php?pageno=<?php echo $pageno==$pagecount?$pagecount:($pageno+1) ?>">下一页</a>
				 <a href="admin.php?pageno=<?php echo $pagecount ?>">尾页</a>
			</td>
		</tr>
	</table>
</body>
</html>