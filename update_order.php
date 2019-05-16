<?php 
$id=$_GET["id"];
include_once 'conn.php';
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
	$card=$_POST["card"];
	$price=$_POST["price"];
	$time=$_POST["time"];
	$remarks=$_POST["remarks"];
	$sql="update ruzhuxinxi set number='$number',name='$name',card='$card',price='$price',time='$time',remarks='$remarks' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','修改客户入住信息','success').then(() => {
					location.href='check_order.php';
			})});
		</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>修改入住信息</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/zane-calendar.css" />
</head>

<body class="add_news_body">
<!--修改入住信息-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">修改入住信息</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
	$sql="select * from ruzhuxinxi where id=".$id;
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
	{
	?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">房间号：</span>
                    <input name='number' type='text' id='number' autocomplete="off" value='<?php echo mysql_result($query,$i,number);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->		
                </li>
                <li>
                    <span class="password">客户姓名：</span>
                    <input name='name' type='text' id='name' autocomplete="off" value='<?php echo mysql_result($query,$i,name);?>' />&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">身份证号：</span>
                    <input name='card' type='text' id='card' autocomplete="off" value='<?php echo mysql_result($query,$i,card);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">价格：</span>
                    <input name='price' type='text' id='price' autocomplete="off" value='<?php echo mysql_result($query,$i,price);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">入住时间：</span>
                    <input name='time' type='text' id="zane-calendar" readonly style="cursor:pointer;" autocomplete="off" value='<?php echo mysql_result($query,$i,addtime);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
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
<!--修改入住信息end-->
<script src="js/zane-calendar.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
	zaneDate({
		elem:'#zane-calendar',
		behindTop:5,
		width:258, 
		format: 'yyyy-MM-dd',
		begintime:'2019/01/01'
	})
	function check()
	{
		if(document.getElementById("number").value==""){
			swal({
			  title: "失败！",
			  text: "房间号不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("number").focus();
			return false;
		}
		if(document.getElementById("name").value==""){
			swal({
			  title: "失败！",
			  text: "客户姓名不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("card").value==""){
			swal({
			  title: "失败！",
			  text: "身份证号不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("card").focus();
			return false;
		}
		if(document.getElementById("price").value==""){
			swal({
			  title: "失败！",
			  text: "价格不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("price").focus();
			return false;
		}
		if(document.getElementById("zane-calendar").value==""){
			swal({
			  title: "失败！",
			  text: "入住时间不能修改为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("zane-calendar").focus();
			return false;
		}
	}
</script>
</body>
</html>

