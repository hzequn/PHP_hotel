<?php
session_start();
include_once 'conn.php';
$addnew=$_POST["addnew"];
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if($addnew=="1")
{
//MD5加盐加密
$salt="skjddq237:&*^$df234GJSN";

$old_password=$_POST['old_password'];
$old_password=$old_password+$salt;
$old_password=md5($old_password);

$new_password=$_POST['new_password'];
$new_password=$new_password+$salt;
$new_password=md5($new_password);

$re_password=$_POST['re_password'];

$sql="select * from allusers where username='".$_SESSION['username']."'";
	
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
		{
			if(mysql_result($query,0,"pwd") == $old_password)
				{
					$sql="update allusers set pwd='$new_password' where username='".$_SESSION['username']."'";
					$query=mysql_query($sql);
					echo 
					"<script>
						$(function(){
							swal('成功','修改密码！','success').then(() => {
							history.back();
						})});
					</script>";
				}
			
			else
				{
					echo 
					"<script>
						$(function(){
							swal('失败','原密码不准确','error').then(() => {
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
							swal('失败','原密码不准确','error').then(() => {
								history.back();
						})});
					</script>";
		}
 }
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>管理员修改密码</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<script>
function check()
{
	if(document.getElementById('old_password').value =="")
	{
		swal({
			  title: "失败！",
			  text: "请输入原密码！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById('old_password').focus();
		return false;
	}
	if(document.getElementById('new_password').value =="")
	{
		swal({
			  title: "失败！",
			  text: "请输入新密码！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById('new_password').focus();
		return false;
	}
	if(document.getElementById('re_password').value =="")
	{
		swal({
			  title: "失败！",
			  text: "请输入确认密码！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById('re_password').focus();
		return false;
	}
	if (document.getElementById('new_password').value != document.getElementById('re_password').value)
	{
		swal({
			  title: "失败！",
			  text: "两次密码不一致！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById('new_password').value="";
		document.getElementById('re_password').value="";
		document.getElementById('new_password').focus();
		return false;
	}
}
</script>
<body>


<!--管理员密码修改-->
<div class="add_admin">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">修改管理员密码</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
	<form id="form1" name="form1" method="post" action="" autocomplete="off">
        <ul>
            <li>
                <span class="user">原密码：</span>
                <input type="password" name="old_password" id="old_password" value=''  placeholder="原密码" class="admin_name" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);"/>*
                <input type="hidden" name="addnew" value="1" />
                <input type='text' style='display:none'> <!-- 针对firefox -->
            </li>
            <li>
                <span class="password">新密码：</span>
                <input type="password" name="new_password" id="new_password" class="pass admin_password1" value='' placeholder="新密码" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);"/>*
                <input type='password' style='display:none'> <!-- 针对firefox -->
            </li>
            <li>
                <span class="password">确认密码：</span>
                <input type='password' autocomplete="new-password"  name="re_password" id="re_password" class="pass admin_password2" value='' placeholder="确认密码" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);" />*
                <input type='password' style='display:none'> <!-- 针对firefox -->
            </li>
        </ul>
        <div class="bottom_box">
        	<input type="submit" name="Submit" value="修改" onClick="return check();">
            <input type="reset" name="Submit2" value="重置"/>
            <input type="hidden" name="addnew" value="1" />
        </div>
    </form> 
</div>
<!--管理员密码修改end-->
</body>
<script>

</script>
</html>

