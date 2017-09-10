<?php

	date_default_timezone_set('prc');
	header("Content-Type:text/html;charset=UTF-8");
	$QQ_ID = $_POST['QQId'];
	$time=date("Y-m-d H:i:s");
	
	$res_ID = "res_".(string)$QQ_ID."_".(string)date('YmdHis');
	$Score_ID = "sco_".(string)$QQ_ID."_".(string)date('YmdHis');

	
	setcookie('res',$res_ID);
	setcookie('sco',$Score_ID);
	
	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	mysqli_query($link,'set names utf8');
	$sql = "insert into quest_man (QQ,Score_ID,res_ID,time) values ('$QQ_ID','$Score_ID','$res_ID','$time')";
	$result = mysqli_query($link,$sql);
	if ($result) {
		echo "<script>location='QuestMain.html';</script>"; 
	} 
	mysqli_close($link);
  ?>