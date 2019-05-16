<?php 
$id=$_GET["id"];
include_once 'conn.php';
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
$sql="select * from liuyanban where id=".$id;
$query=mysql_query($sql);
$rowscount=mysql_num_rows($query);
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" )
{
	$username=$_POST["username"];
    $name=$_POST["name"];
    $picture=$_POST["picture"];
	$remarks=$_POST["remarks"];
	$sql="update liuyanban set username='$username',picture='$picture',name='$name',remarks='$remarks' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','修改订餐信息','success').then(() => {
					location.href='check_meals.php';
			})});
		</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>修改订餐信息</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<script>
function check(){
	if(document.getElementById('remarks').value==""){
		swal({
			  title: "失败！",
			  text: "预订信息不能为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
		document.getElementById("remarks").focus();
		return false;
	}
}
</script>

<body class="add_news_body">
<!--客户订餐修改-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">修改客户订餐信息</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
	$sql="select * from liuyanban where id=".$id;
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
	{
	?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">账号：</span>
                    <input name='username' type='text' id='username' style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,username);?>'/>&nbsp;*		
                </li>
                <li>
                    <span class="password">姓名：</span>
                    <input name='name' type='text' id='name' style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,name);?>'/>&nbsp;*
                </li>
                <li>
                    <span class="password">照片：</span>
                    <input name='picture' type='text' id='picture' style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,picture);?>' />&nbsp;*
                </li>
                <li>
                    <span class="password news_ab">订餐信息：</span>
                    <span class="none"></span>
                    <textarea name="remarks" id="remarks" style="text-align:left;"><?php echo mysql_result($query,$i,remarks);?></textarea>&nbsp;*
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
<!--客户订餐信息修改end-->

</body>
</html>

