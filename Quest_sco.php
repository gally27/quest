<?php
	
	header("Content-Type:text/html;charset=UTF-8");
	
	$fields = $_POST;//你的字段
	foreach($fields as $key => $vals){
		$data[] = $vals;
	}
	$Score_ID = $_COOKIE['sco'];
	
	//echo $Score_ID;
	//exit(0);
	$val = '';
	$val .= "('$Score_ID',";
	
	$str = '';
	for ($i=0; $i<count($data); $i++ ){
		$val .= "'$data[$i]',";	
		$str .= ',Q'.(string)($i+1);
	}
	
	
	
	$vals = substr($val,0,strlen($val)-1);
	$vals .= ")";
	
	$link = mysqli_connect('localhost','root','root','quest') or die('数据库连接失败');
	mysqli_query($link,'set names utf8');

	$sql2 = "insert into quest_sco(Score_ID".$str.") values".$vals;
	
	//echo $sql2;
	//exit(0);
	//$result2 = mysqli_query($link,$sql2);
	//$sql2 = substr( $sql2,0, strlen($sql)-1 );
	$result2 = mysqli_query($link,$sql2);
	if ($result2){
		echo "<script>location='result.php';</script>";
	} 
	
	mysqli_close($link);
	
?>

