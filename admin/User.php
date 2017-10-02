<?php
	
	header("Content-Type:text/html;charset=UTF-8");

	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	
	mysqli_query($link,'set names utf8');
	
	
	//获得要查询分数表列的列名
	$str = '';
	for ($i=0; $i<80; $i++ ){
		$str .= 'Q'.(string)($i+1).',';
	}
	$st = substr($str,0,strlen($str)-1);
	
	//获得要查询的QQ号
	//$time = '';
	$Qid =  $_GET['new'];
	$time = $_GET['new2'];
	
	//拼接查询sql的查询语句
	$sql = "select ".$st." from quest_sco where Score_ID=(select Score_ID from quest_man where QQ='$Qid' and time='$time')";
	$result = mysqli_query($link,$sql);
	
	$arr = mysqli_fetch_assoc($result);
	mysqli_close($link);
	$Q_count = 1;
	$file = fopen("text.txt","w+"); 
	
	
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>评分详情</title>
	<link href="css/result.css" rel="stylesheet" type="text/css">
</head>


<body >
	
	<div style="margin:0 auto; text-align: center;width:1000px; position:relative;">
		<center><h1>QQ号为<?php echo $Qid; ?>的评分详情</h1></center>
		
		<div style="margin:0px auto; width:800px; heigth:50px;">
			<input type=button onclick="window.open('Result.php')" value="返回">
			<input type=button onclick="window.open('download.php')" value="下载">
		</div>
		
		<div style="margin:0px auto; width:800px;">
		<table>
			<tr>
				<th width="80px">序号</th>
				<th width="80px">译文1</th>
				<th width="80px">译文2</th>
				<th width="80px">译文3</th>
				<th width="80px">译文4</th>
				
			</tr>
			
		<?php			
			for ($i=1; $i<=20; $i++){
			?>	
			<tr>
				<td>试题<?php echo $i;?></td>
				<td><?php echo $arr['Q'.(string)($Q_count++)];fwrite($file,$arr['Q'.(string)($Q_count-1)]);?>分</td>
				<td><?php echo $arr['Q'.(string)($Q_count++)];fwrite($file,$arr['Q'.(string)($Q_count-1)]);?>分</td>
				<td><?php echo $arr['Q'.(string)($Q_count++)];fwrite($file,$arr['Q'.(string)($Q_count-1)]);?>分</td>
				<td><?php echo $arr['Q'.(string)($Q_count++)];fwrite($file,$arr['Q'.(string)($Q_count-1)."\\r\\n"]);?>分</td>
			</td>
		
		<?php
			}
			fclose($file);
			?>	
		</table>
		</div>
		
	</div>
	
</body>

</html>


