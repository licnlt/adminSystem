<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户表</title>
	<link rel="stylesheet" href="./css/style.css">
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

		//获取当前页的内容
		$sql="select * from man limit $startno,$pagesize";
		$rs=mysql_query($sql);
		
		
	?>
	<table>
		<th>序号</th>
		<th>姓名</th>
		<th>性别</th>
		<th>成绩</th>
		<?php 
			while($rows=mysql_fetch_assoc($rs)){
				echo '<tr>';
				echo '<td>'.$rows['id'].'</td>';
				echo '<td>'.$rows['name'].'</td>';
				echo '<td>'.$rows['sex'].'</td>';
				echo '<td>'.$rows['score'].'</td>';
				echo '</tr>';
			}
		 ?>
	</table>

	<table>
		<tr>
			<td>
				<a href="showmans.php?pageno=1">首页</a>
				<a href="showmans.php?pageno=<?php echo $pageno==1?1:($pageno-1) ?>">上一页</a> 
				<?php 		
					for ($i=1;$i<=$pagecount;$i++) {
						echo '<a href="showmans.php?pageno='.$i.'">'.$i.'</a>&nbsp';
					}
				 ?>
				 <a href="showmans.php?pageno=<?php echo $pageno==$pagecount?$pagecount:($pageno+1) ?>">下一页</a>
				 <a href="showmans.php?pageno=<?php echo $pagecount ?>">尾页</a>
			</td>
		</tr>
	</table>

</body>
</html>