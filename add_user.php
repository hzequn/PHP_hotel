<?php
include_once 'conn.php';
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" )
{
	$username=$_POST["username"];
	$password=$_POST["password"];
	//MD5加盐加密
	$salt="skjddq237:&*^$df234GJSN";
	$password=$password+$salt;
	$password=md5($password);
	$name=$_POST["name"];
	$sex=$_POST["sex"];
	$address=$_POST["address"];
	$email=$_POST["email"];
	$picture=$_POST["picture"];
	$issh='是';
	$search = "select zhanghao from yonghuzhuce where zhanghao='$username'";
  	$res=mysql_query($search);
  	if(mysql_num_rows($res)>0){
  		echo 
			"<script>
				$(function(){
					swal('失败','用户账号已存在！','error')});
			</script>";
  	}else {
    	$sql="insert into yonghuzhuce(zhanghao,mima,xingming,xingbie,diqu,Email,zhaopian,issh) values('$username','$password','$name','$sex','$address','$email','$picture','$issh')";
		mysql_query($sql);
		echo 
			"<script>
				$(function(){
					swal('成功','添加用户信息','success').then(() => {
						location.href='check_user.php';
				})});
			</script>";
  	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>添加注册用户</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body class="add_news_body">
<script language="javascript">
	function check(){
		if(document.getElementById("username").value==""){
			swal({
			  title: "失败！",
			  text: "请输入用户名！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("username").focus();
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
		if(document.getElementById("name").value==""){
			swal({
			  title: "失败！",
			  text: "请输入姓名！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("sex").value==""){
			swal({
			  title: "失败！",
			  text: "请选择性别！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("sex").focus();
			return false;
		}
		if(document.getElementById("address").value==""){
			swal({
			  title: "失败！",
			  text: "请输入地址！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("address").focus();
			return false;
		}
		if(document.getElementById("email").value==""){
			swal({
			  title: "失败！",
			  text: "请输入邮箱！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("email").focus();
			return false;
		}
		if(document.getElementById("picture").value==""){
			swal({
			  title: "失败！",
			  text: "请选择头像！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("picture").focus();
			return false;
		}
	}
	function uploadImg(){
			var url = "upfile.php";
			var data = new FormData($("#form1")[0])
			$.ajax({
				url: url,
				type: "POST",
				data:data,
				contentType:false,
				processData:false,
				success: function(res){
					document.getElementById("picture").value=res;
				}
					
			})
		}
	$(function(){
		$("#uploadImg").change(function(){
			uploadImg();
		})
	})
</script>

<!--注册用户添加-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">注册用户添加</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">用户账号：</span>
                    <input name='username' type='text' id='username' autocomplete="off" value='' placeholder="请输入用户账号"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              	</li>
                <li>
                    <span class="password">用户密码：</span>
                    <input name='password' type='password' id='password' value='' autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);" placeholder="请输入用户密码"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              	</li>
                <li>
                    <span class="password">用户姓名：</span>
                    <input name='name' type='text' id='name' autocomplete="off" value='' placeholder="请输入用户姓名"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              	</li>
                <li>
                    <span class="password">用户邮箱：</span>
                    <input name='email' type='text' id='email' autocomplete="off" value='' placeholder="请输入用户邮箱"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              	</li>
                <li>
                    <span class="password">用户性别：</span>
                    <select name='sex' id='sex'>
                          <option value="男">男</option>
                          <option value="女">女</option>
                    </select>
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              	</li>
            	<li>
                    <span class="password">家庭地址：</span>
                    <input name='address' type='text' id='address' autocomplete="off" value='' placeholder="请输入家庭地址" />&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
            	</li>
               	<li style="position:relative;height:35px;">
                    <span class="password">用户头像：</span>
                    <input name='picture' type='text' id='picture' value='' readonly autocomplete="off" placeholder="点击上传图片" style="cursor:pointer;"/>
                    <input id="uploadImg" name="upfile" type="file" class="imgBtn" style="cursor:pointer;"/>
                </li>
            </ul>
            <div class="bottom_box">
               	<input type="submit" name="Submit" value="添加" onClick="return check();" />
                <input type="reset" name="Submit2" value="重置"/>
                <input type="hidden" name="addnew" value="1" />
            </div>
        </form> 
    </div>
</div>
<!--注册用户添加end-->
</body>
</html>


