<?php
	
	header("Content-Type:text/html;charset=UTF-8");

	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	
	mysqli_query($link,'set names utf8');
	
	

	$sql = "select QQ,pass,time,avg,kappa from quest_man,quest_res where quest_man.res_ID=quest_res.res_ID order by time desc";
	
	$result = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_assoc($result)){
		$arr[] = $row;
	}
	//print_r($arr); 
	
	//exit(0);
	
?>



<html>
	<style>
		body{
			margin:0px;
			padding:0px;
		}
		h1
		{
			width:10%;
			margin:0px auto;
		}
		.listbox{
			width:100%;
			margin:0px auto;
		}
		.box{
			margin:0px auto; 	
			width:100%;
			height:86%;
			overflow:auto;
		}
		.headtab{
			width:90%;
			height:30px;
			padding:0px;
			margin:0px auto;
		}
		.headtab tr td
		{
			text-align:center;
			font-size:25px;
			font-weight:bold;
			width:16%;
		}
		.tab
		{
			margin:0px auto;
			width:90%;
			
		}
		.tab tr td
		{
			text-align:center;
			width:16%;
		}
		
		.tab tr {
			height:50px;
		}
	</style>
	<head>
		<meta charset="utf-8"/>
		<title>腾讯翻译 - 做题处理结果</title>
	</head>
	
	<body>
		<div class="head">
		<h1>处理结果</h1>
		</div>
		<div class="listbox">
			<table class="headtab">
				<tr>
					<td>账号</td>
					<td>结果</td>
					<td>时间</td>
					<td>kappa系数</td>
					<td>平均值</td>
					<td>详情</td>
				</tr>
				</table>
				</div>
		<div class="box">
				
			<table class="tab">
			<?php			
		foreach ($arr as  $key=>$value) :
		?>
				<tr>
					<td><?php echo $value['QQ'];?></td>
					
					<?php  if($value['pass'] == '通过') {?>
						<td style="color:green;"><?php echo $value['pass'];?></td>
					<?php } else { ?>
						<td style="color:red;"><?php echo $value['pass'];?></td>
					<?php } ?>
					
					
					<td><?php echo $value['time'];?></td>
					<td><?php echo $value['kappa'];?></td>
					<td><?php echo $value['avg'];?></td>
					<td><a href="User.php?new=<?php echo $value['QQ'];?>&new2=<?php echo $value['time']; ?>">点击进入</a></td>
				</tr>
				<?php endforeach;?>
			</table>
			
		</div>
	
	</body>
</html>
