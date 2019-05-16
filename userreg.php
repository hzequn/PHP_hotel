<?php 
include_once 'conn.php';
$ndate =date("Y-m-d");
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" ){
 if(isset($_POST['zhanghao'])){
  	$search = "select zhanghao from yonghuzhuce where zhanghao='$zhanghao'";
	$zhanghao=$_POST["zhanghao"];
	$mima=$_POST["mima"];
	//MD5加盐加密
	$salt="skjddq237:&*^$df234GJSN";
	$mima=$mima+$salt;
	$mima=md5($mima);
  	$res=mysql_query($search);
  	if(mysql_num_rows($res)>0){
  		echo 
			"<script>
				$(function(){
					swal('失败','用户名已存在','error')});
			</script>";
  	}else {
    	$query="insert into yonghuzhuce(zhanghao,mima) values ('$zhanghao','$mima')";
  	if(mysql_query($query)){
  		echo 
			"<script>
				$(function(){
					swal('成功','注册成功','success').then(() => {
						location.href='index.php';
				})});
			</script>";
  	}else{
  		echo '失败，请重新尝试!',mysql_error();
  	}
  	die;
  	}
  }
}
?>
<html>
<head>
<title>酒店管理信息系统</title>

</head>
    <!--注册-->
    <div class="reg txt_none" id="reg_show">
        <div class="reg_box">
        	<span class="close"><img src="img/close.png"/></span>
        	<h2>用户注册</h2>
            <form name="form1" method="post" action="">
                <ul>
                    <li>
                        <span class="user"><img src="img/user.png"/></span>
                        <input type="text" name="zhanghao" id="zhanghao" value='' placeholder="用户名" autocomplete="off"/>
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                    </li>
                    <li>
                        <span class="password"><img src="img/password.png"/></span>
                        <input type="password" name="mima" class="pass" id="password" value='' placeholder="密码" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);" />
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                    </li>
                    <li style="margin-bottom:10px;">
                        <span class="password"><img src="img/password.png"/></span>
                        <input type="password" name="remima" class="pass" id="repassword" value='' placeholder="确认密码" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);" />
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                    </li>
                    <!--提示语-->
					<p class="warning_tips1" id="warning_tips1"></p>
                    <p class="warning_tips2" id="warning_tips2"></p>
                </ul>
                <div class="bottom_box">
                    <input type="submit" name="Submit" value="注册" onclick="return check();"/>
                    <input type="hidden" name="addnew" value="1" />
                </div>
                <div class="login_link" id="login_link">
                	<p>已有账号?去<span>登录</span></p>
                </div>
            </form> 
        </div>
    </div>
    <!--注册end-->
    <!--登录-->
    <div class="reg txt_none" id="login_show">
        <div class="reg_box">
        	<span class="close"><img src="img/close.png"/></span>
        	<h2>用户登录</h2>
            <form name="userlog" method="post" action="userlog_post.php" id="userlog">
                <ul class="login_box_ul">
                    <li>
                    	账号：<input name="username" type="text" id="username" placeholder="请输入用户名" autocomplete="off"/>
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                    </li>
                    <li>
                    	密码：<input name="pwd1" type="password" id="pwd1" placeholder="请输入密码" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);"/>
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                    </li>
                </ul>
                <div class="bottom_box">
                    <input type="submit" name="Submit" value="登陆" />
                    <input type="reset" name="Submit2" value="重置" />
                </div>
                <div class="login_link" id="userreg_link">
                	<p>没有账号?去<span>注册</span></p>
                </div>
            </form> 
        </div>
    </div>
    <!--登录end-->
<script>
	//用户名校验
	var regExp = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{3,12}$/;//英文+数字,长度3-12位
　　$("#zhanghao").keyup(function(){
		var $value=$(this).val();
		if(!regExp.test($value)){
			$('#warning_tips1').html("请输入3-12位的数字+英文组合的账号");
			return false;
		}else{
			$('#warning_tips1').html("");
		}
　　}); 
	//密码校验
	var passreg=new RegExp("^[0-9]{6,12}$");//密码长度为6-12位的数字
	$("#password").keyup(function(){
		var $value=$(this).val();
		if(!passreg.test($value)){
			$('#warning_tips2').html("请输入6-12位的纯数字密码");
			return false;
		}else{
			$('#warning_tips2').html("");
		}
　　}); 
	//控制校验
	function check(){
		if(document.getElementById("zhanghao").value==""){
			swal({
			  title: "失败！",
			  text: "请输入账号！",
			  icon: "error",
			  showConfirmButton: true
			})
			document.getElementById("zhanghao").focus();
			return false;
		}
		if(document.getElementById("password").value==""){
			swal({
			  title: "失败！",
			  text: "请输入密码！",
			  icon: "error",
			  showConfirmButton: true
			})
			document.getElementById("password").focus();
			return false;
		}
		if(document.getElementById("repassword").value==""){
			swal({
			  title: "失败！",
			  text: "请输入确认密码！",
			  icon: "error",
			  showConfirmButton: true
			})
			document.getElementById("repassword").focus();
			return false;
		}
		if(document.getElementById("repassword").value != document.getElementById("password").value){
			swal({
			  title: "失败！",
			  text: "两次密码不一致！",
			  icon: "error",
			  showConfirmButton: true
			})
			return false;
			document.getElementById("password").value=="";
			document.getElementById("repassword").value=="";
			document.getElementById("password").focus();
		}
		if($('#warning_tips1').html() != "" || $('#warning_tips2').html() != ""){
			
			swal({
			  title: "失败！",
			  text: "请输入正确的格式！",
			  icon: "error",
			  showConfirmButton: true
			})
			return false;
			document.getElementById("zhaohao").value=="";
			document.getElementById("password").value=="";
			document.getElementById("repassword").value=="";
			document.getElementById("zhaohao").focus();
			
		}
			
	}
</script>
</body>
</html>
