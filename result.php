<?php
	date_default_timezone_set('prc');
	header("Content-Type:text/html;charset=UTF-8");

	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	
	mysqli_query($link,'set names utf8');
	$Scoreid = $_COOKIE['sco'];
	$sql = "select * from `quest_sco` where Score_ID='$Scoreid'";
	
	$result = mysqli_query($link,$sql);
	
	mysqli_close($link);
	$arr = mysqli_fetch_assoc($result);
	
	
	//print_r($arr);
	//exit(0);
	
	foreach($arr as $key => $vals){
		$data[] = $vals;
	}
	
	//原始平均值
	$avg = array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,
					2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2);
	//print_r($avg);
	//exit(0);
	
	function avgtion($avg,$x){//返回绝对值
		return abs($avg-$x);
	}
	$sum_avg = 0;//初始绝对值得和
	for ($i = 1; $i <count($arr); $i++){
		$abs_avg[] = avgtion($avg[$i-1],$data[$i]); 
	}
	
	
	for ($i = 0; $i < count($abs_avg); $i++){
		$sum_avg = $sum_avg+$abs_avg[$i];
	}
	//print_r($sum_avg);
	//exit(0);
	$res_avg = $sum_avg/(count($abs_avg));//最终平均值
	//print_r($res_avg);
	//exit(0);
	
	
	//判断pass，是否通过
	$judge_avg = 2;
	
	//print_r($res_avg);
	//exit(0);
	$pass = '';
	if ($res_avg>=$judge_avg){
		$pass = "通过";
	}else{
		$pass = "失败";
	}
	
	//获取系统时间
	$time=date("Y-m-d H:i:s");
	
	//获取结果表的resid
	$Score_ID = $_COOKIE['res'];
	
	$sql1 = "insert into quest_res(res_ID,pass,avg,kappa) values ('$Score_ID','$pass','$res_avg',1)";
	//print_r($sql1);
	//exit(0);
	$link1 = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	
	mysqli_query($link1,'set names utf8');
	
	$result1 = mysqli_query($link1,$sql1);
	if ($result1) {
		echo "<script>location='thank.html';</script>";
	} 
	mysqli_close($link1);
?>