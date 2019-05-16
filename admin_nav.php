<?php
session_start();
	
	if($_SESSION['cx']=="注册用户")
	{
		echo "<script>javascript:location.href='admin_user.html';</script>";
	}
	else if($_SESSION['cx']=="普通管理员")
	{
		echo "<script>javascript:location.href='admin_normal.html';</script>";
	}
else  
	{
		echo "<script>javascript:location.href='admin_super.html';</script>";
	}
	
?>