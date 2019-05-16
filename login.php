<?php
//验证登陆信息
session_start();
include_once 'conn.php';
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
	$login=$_POST["login"];
	$username=$_POST['username'];
	$pwd=$_POST['pwd'];
	//MD5加盐加密
	$salt="skjddq237:&*^$df234GJSN";
	$pwd=$pwd+$salt;
	$pwd=md5($pwd);
	if($login=="1")
	{
		if ($username!="" && $pwd!="")
		{
		$sql="select * from allusers where username='$username' and pwd='$pwd'";
		$query=mysql_query($sql);
		$rowscount=mysql_num_rows($query);
			if($rowscount>0)
			{
					$_SESSION['username']=$username;
					$_SESSION['cx']=mysql_result($query,0,"cx");
					echo 
						"<script>
							$(function(){
								swal('后台登录','登录成功','success').then(() => {
									location.href='main.php';
							})});
						</script>";
			}
			else
			{
					echo 
						"<script>
							$(function(){
								swal('失败','用户名或密码错误！','error').then(() => {
									history.back();
							})});
						</script>";
			}
		}
		else
		{
				echo 
				"<script>
					$(function(){
						swal('失败','请输入完整信息','error').then(() => {
							history.back();
					})});
				</script>";
		}
	}
?>