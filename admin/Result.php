<?php
	
	header("Content-Type:text/html;charset=UTF-8");

	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	
	mysqli_query($link,'set names utf8');
	
	

	$sql = "select QQ,pass,time,avg,kappa from quest_man,quest_res where quest_man.res_ID=quest_res.res_ID";
	
	$result = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_assoc($result)){
		$arr[] = $row;
	}
	//print_r($arr); 
	
	//exit(0);
	mysqli_close($link);
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>腾讯翻译 - 做题处理结果 </title>
	<meta name="Copyright" content="Douco Design." />
	<link href="css/public.css" rel="stylesheet" type="text/css">
</head>
<body>

	
  <div class="box">
        
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
	<center><h1>处理结果</h1></center>
     <tr>
        <th width="120" align="left">账号</th>
		<th width="120" align="left">结果</th>
		<th width="120" align="left">时间</th>
		<th width="120" align="left">平均值</th>
		<th width="120" align="left">Kappa系数</th>
        <th width="80" align="center">详情</th>
      </tr>
	  
	  <?php			
		foreach ($arr as  $key=>$value) :
		?>
        <tr>
			<td align="left"><?php echo $value['QQ'];?></td>
			<td align="left"><?php echo $value['pass'];?></td>
			<td align="left"><?php echo $value['time'];?></td>
			<td align="left"><?php echo $value['avg'];?></td>
			<td align="left"><?php echo $value['kappa'];?></td>
			
			<td align="left"> <a href="User.php?new=<?php echo $value['QQ'];?>">点击进入</a></td>
		</tr>
	  <?php endforeach;?>
            
          </table>
           </div>
</body>
</html>