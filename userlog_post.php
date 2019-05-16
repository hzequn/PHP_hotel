<?php
//验证登陆信息
session_start();
include_once 'conn.php';
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
	$username=$_POST['username'];
	$pwd=$_POST['pwd1'];
	//MD5加盐解密
	$salt="skjddq237:&*^$df234GJSN";
	$pwd=$pwd+$salt;
	$pwd=md5($pwd);
	if ($username!="" && $pwd!="")
	{
	$sql="select * from yonghuzhuce where zhanghao='$username' and mima='$pwd'";//and issh='是' and `undo`='否'
	$sql1="select * from yonghuzhuce where zhanghao='$username' and mima='$pwd' and issh='是'";//and `undo`='否'
	$sql2="select * from yonghuzhuce where zhanghao='$username' and mima='$pwd' and issh='是' and `undo`='否'";
	$query=mysql_query($sql);
	$query1=mysql_query($sql1);
	$query2=mysql_query($sql2);
	if(mysql_num_rows($query) > 0){
		if(mysql_num_rows($query1) > 0){
			if(mysql_num_rows($query2) > 0){
				$_SESSION['username']=$username;//保存用户名
				$_SESSION['cx']="注册用户";
				$_SESSION['xm']=mysql_result($query,$i,xingming);
				$_SESSION['zp']=mysql_result($query,$i,zhaopian);
				echo 
					"<script>
						$(function(){
							swal('成功','登录系统','success').then(() => {
								location.href='index.php';
						})});
					</script>";
			}else{
				echo 
					"<script>
						$(function(){
							swal('失败','您的账户已停用，请联系管理员！','error').then(() => {
								history.back();
						})});
					</script>";
			}
		}else{
			echo 
				"<script>
					$(function(){
						swal('失败','您的账户未经审核！','error').then(() => {
							history.back();
					})});
				</script>";
		}
	}else{
		echo 
			"<script>
				$(function(){
					swal('失败','用户名错误或密码错误！','error').then(() => {
						history.back();
				})});
			</script>";
	}
}
?>