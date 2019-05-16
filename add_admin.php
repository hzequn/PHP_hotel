<?php
	date_default_timezone_set('PRC'); 
	$ndate=date("Y-m-d");
	include_once 'conn.php';
	$addnew=$_POST["addnew"];
	?>
    <script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
    <?php

		$username=$_POST['username'];
		//MD5加盐加密
		$salt="skjddq237:&*^$df234GJSN";
		
		$pwd1=$_POST['pwd1'];
		$pwd1=$pwd1+$salt;
		$pwd1=md5($pwd1);
		
		$pwd2=$_POST['pwd2'];
		$pwd2=$pwd2+$salt;
		$pwd2=md5($pwd2);
		$cx=$_POST['cx'];
	if($username!="" && $pwd1!="" && $pwd2!="")
	{
		$sql="select * from allusers where username='$username' and pwd='$pwd1'";
		$query=mysql_query($sql);
		$rowscount=mysql_num_rows($query);
		if($rowscount > 0)
			{					
				echo 
					"<script>
						$(function(){
							swal('失败','已存在管理员账号','error')
						});
					</script>";
			}
			else
			{
					$ndate =date("Y-m-d");
					$sql="insert into allusers(username,pwd,cx) values('$username','$pwd1','$cx')";
					mysql_query($sql); 
					echo 
						"<script>
							$(function(){
								swal('成功','添加管理员','success')
							});
						</script>";
			}
			$_SESSION['cx']=="超级管理员";
		}
		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>添加新管理员</title>
</head>
<script>
function check(){
	if(document.getElementById("username").value==""){
		swal({
			  title: "失败！",
			  text: "请输入账号！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById("username").focus();
		return false;
	}
	if(document.getElementById("pwd1").value==""){
		swal({
			  title: "失败！",
			  text: "请输入密码！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById("pwd1").focus();
		return false;
	}
	if(document.getElementById("pwd2").value==""){
		swal({
			  title: "失败！",
			  text: "请输入确认密码！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById("pwd2").focus();
		return false;
	}
	if(document.getElementById("pwd2").value != document.getElementById("pwd1").value){
		swal({
			  title: "失败！",
			  text: "两次密码不一致！",
			  icon: "error",
			  showConfirmButton: true
         })
		document.getElementById("pwd1").value="";
		document.getElementById("pwd2").value="";
		document.getElementById("pwd1").focus();
		return false;
	}
}
</script>
<body>
<!--添加管理员-->
<div class="add_admin">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">添加新管理员</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
	<form id="form1" name="form1" method="post" action="">
        <ul>
            <li>
                <span class="user">账号：</span>
                <input type="text" name="username" id="username" value=''  placeholder="用户名" class="admin_name" autocomplete="off"/>*
                <input type='text' style='display:none'> <!-- 针对firefox -->
                <input type="hidden" name="addnew" value="1" />
            </li>
            <li>
                <span class="password">密码：</span>
                <input type="password" name="pwd1" class="pass admin_password1" id=" pwd1" value='' placeholder="密码" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);"/>*
                <input type='text' style='display:none'> <!-- 针对firefox -->
            </li>
            <li>
                <span class="password">确认密码：</span>
                <input type="password" name="pwd2" class="pass admin_password2" id="pwd2" value='' placeholder="确认密码" autocomplete="new-password" readonly onFocus="this.removeAttribute('readonly');" onBlur="this.setAttribute('readonly',true);"/>*
                <input type='text' style='display:none'> <!-- 针对firefox -->
            </li>
            <li>
                <span class="password">系统权限</span>
                <select name='cx' id='cx'>*
                      <option value="普通管理员">普通管理员</option>
                      <option value="超级管理员">超级管理员</option>
                </select>
            </li>
        </ul>
        <div class="bottom_box">
        	<input type="submit" name="Submit" value="添加" onClick="return check();" >
            <input type="reset" name="Submit2" value="重置"/>
        </div>
    </form> 
    <div class="clearfix admin_con_top">
        <div class="clearfix admin_con_top">
    	<h2 class="fl">已有管理员列表</h2>
        <?php 
			$sql="select * from allusers where 1=1";
			$query=mysql_query($sql);
			$rowscount=mysql_num_rows($query);
		?>
        <p class="fr">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
	</div>
    <div class="admin_list">
    	<table class="table table-striped">
            <tr>
                <th>编号</th>
                <th>账号</th>
                <th>密码</th>
                <th>系统权限</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
                  $sql="select * from allusers order by id desc";
                  $query=mysql_query($sql);
                  $rowscount=mysql_num_rows($query);
                 for($i=0;$i<$rowscount;$i++)
                 {
            ?>
            <tr>
                <td><?php echo $i+1;?></td>
                <td><?php echo mysql_result($query,$i,"username");?></td>
                <td><?php echo mysql_result($query,$i,"pwd");?></td>
                <td><?php echo mysql_result($query,$i,"cx");?></td>
                <td><?php echo date('Y-m-d',strtotime(mysql_result($query,$i,"addtime")));?></td>
                <td>
                    <a  href="del.php?id=<?php echo mysql_result($query,$i,"id");?>&tablename=allusers" 
                    onClick="return confirm('真的要删除？')">
                        <i class="fa fa-trash b_r b_red material-icons"></i>
                        <span class="text_red">删除<span>
                    </a>
                </td>
            </tr>
        <?php
		}
		 ?>
		</table>
    </div>
</div>
<!--添加管理员end-->
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/CustomScrollbar.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
