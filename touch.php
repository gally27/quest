<?php
	date_default_timezone_set('prc');
	header("Content-Type:text/html;charset=UTF-8");
	//print_r($_POST);
	//exit(1);
	$fields = $_POST;//你的字段
	foreach($fields as $key => $val){
		$data[] = $val;
	}
	
	$val = '';
	$a = 1;
	
	for ($i=1; $i<=20; $i++ ){
			$val .= "(";
			for($j=1; $j<=5; $j++){
				if ($j < 5){
					$val .= "'$data[$a]',";
					$a++;
				} else {
					$val .= "'$data[$a]'),";
					$a++;
				}
			}
	}
	$time=date("Y-m-d H:i:s");
	$QQ_ID = $_POST['QQ_ID'];
	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	mysqli_query($link,'set names utf8');
	mysql_query("SET AUTOCOMMIT=0");//设置为不自动提交，因为MYSQL默认立即执行
	mysql_query("BEGIN");//开始事务定义
	$sql1 = "insert into quest_man (QQ,time) values ('$QQ_ID','$time')";
	//$result1 = mysqli_query($link,$sql1);
	$sql2 = "insert into quest_sco (Score_ID,Q1,Q2,Q3,Q4) values".$val;
	//$result2 = mysqli_query($link,$sql2);
	$sql2 = substr( $sql2,0, strlen($sql)-1 );
	//print_r($sql2);
	//exit(0);
	if (!mysqli_query($link,$sql1)){
		mysql_query("ROLLBACK");//判断当执行失败时回滚
	}
	if (!$result2 = mysqli_query($link,$sql2)){
		mysql_query("ROLLBACK");//判断执行失败回滚
	}
	
	mysql_query("COMMIT");//执行事务
		
	
	echo "<script>location='result.php';</script>";
	
?>

