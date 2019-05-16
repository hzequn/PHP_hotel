<?php 
$id=$_GET["id"];
include_once 'conn.php';
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
$sql="select * from jiudianyuding where id=".$id;
$query=mysql_query($sql);
$rowscount=mysql_num_rows($query);
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" )
{
	$name=$_POST["name"];
    $grade=$_POST["grade"];
    $price=$_POST["price"];
    $time=$_POST["time"];
	$personal=$_POST["personal"];
	$number=$_POST["number"];
	$remarks=$_POST["remarks"];
	$sql1="update jiudianyuding set name='$name',grade='$grade',price='$price',state='$state',personal='$personal',time='$time',number='$number',remarks='$remarks' where id= ".$id;
	mysql_query($sql1);
	$sql2="update jiudianyuding set issh='否' where id=$id";
	mysql_query($sql2);
	echo
		"<script>
			$(function(){
				swal('成功','修改个人订单信息','success').then(() => {
					location.href='check_notes.php';
			})});
		</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>客户个人订单信息修改</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<script language="javascript" src="js/Calendar.js"></script>
</head>
<body class="add_news_body">
<!--客户个人订单信息修改-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">客户个人订单信息修改</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
$sql="select * from jiudianyuding where id=".$id;
$query=mysql_query($sql);
$rowscount=mysql_num_rows($query);
if($rowscount>0)
{
?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">客房名称：</span>
                    <input name='name' type='text' id='name' class="disable" style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,name);?>'/>&nbsp;*		
                </li>
                <li>
                    <span class="password">客房星级：</span>
                    <input name='grade' type='text' id='grade' class="disable" style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,grade);?>' />&nbsp;*
                </li>
                <li>
                    <span class="password">客房价格：</span>
                    <input name='price' type='text' id='price' class="disable" style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,price);?>'/>&nbsp;*
                </li>
                <li>
                    <span class="password">客户姓名：</span>
                    <input name='personal' type='text' id='personal' value='<?php echo mysql_result($query,$i,personal);?>'/>&nbsp;*
                </li>
                <li>
                    <span class="password">预定时间：</span>
                    <input name='time' type='text' id='time' class="disable" style="cursor:not-allowed" readonly value='<?php echo date("Y/m/d",strtotime(mysql_result($query,$i,addtime)));?>'/>&nbsp;*
                </li>
                 <li>
                    <span class="password">预订人数：</span>
					<input name='number' type='text' id='number' value='<?php echo mysql_result($query,$i,number);?>'/>&nbsp;*
                </li>
				<li>
                	<span class="password news_ab">备注信息：</span>
                    <span class="none"></span>
                    <textarea name="remarks" id="remarks" value=""/><?php echo mysql_result($query,$i,remarks);?></textarea>
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
<!--客户个人订单信息修改end-->
</body>
</html>