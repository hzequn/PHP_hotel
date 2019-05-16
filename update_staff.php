<?php 
$id=$_GET["id"];
include_once 'conn.php';
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
$sql="select * from yuangongxinxi where id=".$id;
$query=mysql_query($sql);
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
	$sql="update yuangongxinxi set number='$number',name='$name',address='$address',card='$card',time='$time',price='$price',age='$age',job='$job',remarks='$remarks' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','修改员工信息','success').then(() => {
					location.href='check_staff.php';
			})});
		</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>修改员工信息</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/zane-calendar.css" />
</head>
<script language="javascript">
function check(){
		if(document.getElementById("name").value==""){
			swal({
			  title: "失败！",
			  text: "员工姓名不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("address").value==""){
			swal({
			  title: "失败！",
			  text: "员工地址不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("address").focus();
			return false;
		}
		if(document.getElementById("card").value==""){
			swal({
			  title: "失败！",
			  text: "身份证号码不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("card").focus();
			return false;
		}
		if(document.getElementById("time").value==""){
			swal({
			  title: "失败！",
			  text: "入职时间不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("time").focus();
			return false;
		}
	}
</script>
<body class="add_news_body">
<!--员工信息修改-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">员工信息修改</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
	$sql="select * from yuangongxinxi where id=".$id;
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
	{
	?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">员工工号：</span>
                    <input name='number' type='text' id='number' style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,number);?>'/>&nbsp;*		
                </li>
                <li>
                    <span class="password">员工姓名：</span>
                    <input name='name' type='text' id='name' value='<?php echo mysql_result($query,$i,name);?>' autocomplete="off"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">家庭地址：</span>
                    <input name='address' type='text' id='address' value='<?php echo mysql_result($query,$i,address);?>'autocomplete="off"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">身份证号：</span>
                    <input name='card' type='text' id='card' value='<?php echo mysql_result($query,$i,card);?>' autocomplete="off"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">入职时间：</span>
                    <input name='time' type='text' id="zane-calendar" readonly value='<?php echo mysql_result($query,$i,addtime);?>' autocomplete="off" style="cursor:pointer;"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
				<li>
                	<span class="password">员工薪资：</span>
                    <input name="price" type='text' id="price" value="<?php echo mysql_result($query,$i,price);?>" autocomplete="off"/></input>
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                	<span class="password">员工工龄：</span>
                    <input name="age" type='text' id="age" value="<?php echo mysql_result($query,$i,age);?>" autocomplete="off"/></input>
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                	<span class="password">员工岗位：</span>
                    <select name="job" type='text' id="job" value="<?php echo mysql_result($query,$i,job);?>"/>&nbsp;*
                          <option value="经理">经理</option>
                          <option value="厨师">厨师</option>
                          <option value="勤杂工">勤杂工</option>
                          <option value="服务员">服务员</option>
                	</select>
                </li>
                <li>
                	<span class="password news_ab">备注信息：</span>
                    <span class="none"></span>
                    <textarea name="remarks" id="remarks" /><?php echo mysql_result($query,$i,remarks);?></textarea>
                </li>
            </ul>
            <div class="bottom_box">
                <input type="submit" name="Submit" value="修改"  onclick="return check();" >
                <input type="reset" name="Submit2" value="重置"/>
                <input type="hidden" name="addnew" value="1" />
            </div>
        </form> 
        <?php
			}
		?>
    </div>
</div>
<!--员工信息修改end-->
<script src="js/zane-calendar.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
	zaneDate({
		elem:'#zane-calendar',
		behindTop:5,
		width:258, 
		format: 'yyyy-MM-dd',
		begintime:'2019/01/01',
	})
</script>
</body>
</html>

