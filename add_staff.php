<?php
session_start();
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
	$number=$_POST["number"];
	$name=$_POST["name"];
	$address=$_POST["address"];
	$card=$_POST["card"];
	$time=$_POST["time"];
	$price=$_POST["price"];
	$age=$_POST["age"];
	$job=$_POST["job"];
	$remarks=$_POST["remarks"];
	$sql="insert into yuangongxinxi(number,name,address,card,time,price,age,job,remarks) values('$number','$name','$address','$card','$time','$price','$age','$job','$remarks') ";
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','添加员工信息','success').then(() => {
					location.href='check_staff.php';
			})});
		</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>系统后台员工信息添加</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/zane-calendar.css" />
</head>
<body class="add_news_body">
<script language="javascript">
	function check(){
		if(document.getElementById("number").value==""){
			swal({
			  title: "失败！",
			  text: "请输入员工工号！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("number").focus();
			return false;
		}
		if(document.getElementById("name").value==""){
			swal({
			  title: "失败！",
			  text: "请输入员工姓名！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("address").value==""){
			swal({
			  title: "失败！",
			  text: "请输入家庭住址！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("address").focus();
			return false;
		}
		if(document.getElementById("card").value==""){
			swal({
			  title: "失败！",
			  text: "请输入身份证号码！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("card").focus();
			return false;
		}
		if(document.getElementById("zane-calendar").value==""){
			swal({
			  title: "失败！",
			  text: "请选择入职时间！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("zane-calendar").focus();
			return false;
		}
		if(document.getElementById("price").value==""){
			swal({
			  title: "失败！",
			  text: "请输入员工薪资！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("price").focus();
			return false;
		}
	}
</script>

<!--员工信息添加-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">员工信息添加</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">员工工号：</span>
                    <input name='number' type='text' id='number' autocomplete="off" value='' placeholder="请输入员工工号"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              </li>
                <li>
                    <span class="password">员工姓名：</span>
                    <input name='name' type='text' id='name' value='' autocomplete="off" placeholder="请输入员工姓名"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              </li>
                <li>
                    <span class="password">员工地址：</span>
                    <input name='address' type='text' id='address' autocomplete="off" value='' placeholder="请输入员工地址"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              </li>
                <li>
                    <span class="password">身份证号：</span>
                    <input name='card' type='text' id='card' autocomplete="off" value='' placeholder="请输入身份证号"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              </li>
                <li style="position:relative;">
                    <span class="password">入职时间：</span>
                    <input name='time' type='text' id="zane-calendar" readonly style="cursor:pointer;" autocomplete="off" value='' placeholder="请选择入职时间"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
              </li>
                <li>
                    <span class="password">员工薪资：</span>
                    <input name='price' type='text' id='price' autocomplete="off" value='' placeholder="请输入员工薪资"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">员工工龄：</span>
                    <select name='age' id='age'>
                          <option value="无">无</option>
                          <option value="半年">半年</option>
                          <option value="一年">一年</option>
                          <option value="两年">两年</option>
                          <option value="三年">三年</option>
                    </select>
                </li>
                <li>
                    <span class="password">员工岗位：</span>
                    <select name='job' id='job'>
                          <option value="经理">经理</option>
                          <option value="厨师">厨师</option>
                          <option value="勤杂工">勤杂工</option>
                          <option value="服务员">服务员</option>
                    </select>
                </li>
                <li style="height:45px;">
                    <span class="password news_ab">其他备注：</span>
                    <span class="none"></span>
                    <textarea name="remarks" Iid="remarks" placeholder="请输入备注"></textarea>
                </li>
            </ul><input type='text' style='display:none'> <!-- 针对firefox -->
            <div class="bottom_box">
               	<input type="submit" name="Submit" value="添加" onClick="return check();" />
                <input type="reset" name="Submit2" value="重置"/>
                <input type="hidden" name="addnew" value="1" />
            </div>
        </form> 
    </div>
</div>
<!--员工信息添加end-->
<script src="js/zane-calendar.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
	zaneDate({
		elem:'#zane-calendar',
		behindTop:5,
		width:258, 
		format: 'yyyy-MM-dd'
	})
</script>
</body>
</html>
