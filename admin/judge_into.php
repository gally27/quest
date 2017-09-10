<?php
	header("Content-Type:text/html;charset=UTF-8");
	//print_r($_POST);//$_POST=array();
	
	$uid = $_POST['uid'];
	$password = $_POST['password'];
	
	if ($uid == "123"){
		if ($password = "root"){
			echo "<script>location='Result.php';</script>";
		}
	}else{
		echo "<script>alert('密码或账号输入错误请重新输入！！！'); location='login.html';</script>";
	}
?>