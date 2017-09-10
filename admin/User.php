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
	$Qid =  $_GET['new'];
	
	//拼接查询sql的查询语句
	$sql = "select ".$st." from quest_sco where Score_ID=(select Score_ID from quest_man where QQ='$Qid')";
	
	
	//print_r($sql); 
	//print_r($sql); 
	
	//exit(0);
	
	$result = mysqli_query($link,$sql);
	
	$arr = mysqli_fetch_assoc($result);
	//print_r($arr); 
	
	//exit(0);
	
	mysqli_close($link);
	$Q_count = 1;
	
?>

<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>评分详情</title>
	<link href="css/result.css" rel="stylesheet" type="text/css">
</head>


<body >
	
	<div style="margin:0 auto; text-align: left;width:1000px; position:relative;">
		<center><h1>评分详情</h1></center>
		 <?php			
			for ($i=1; $i<=20; $i++){
			?>
			<h4>
				<span class="subject">原文：<?php echo $i ; ?></span>
			</h4>
				<?php
				for ($j=1; $j<=4; $j++){

		?>
		
		<div>
		
		<div id="item">
			
			
			<p>译文<?php echo $j;?>：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arr['Q'.(string)($Q_count++)];?>分</p><br/><br/>
				
		
		
		
			<?php }}?>	
			<p><a href="Result.php">返回处理结果页面</a></p>
		</div>
		</div>
	</div>
	
</body>

</html>

