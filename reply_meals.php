<?php 
$id=$_GET["id"];
include_once 'conn.php';
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1")
{
	$reply=$_POST["reply"];
	$sql="update liuyanban set reply='$reply' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
		   $(function(){
			swal('成功','回复订餐信息','success').then(() => {
			 location.href='check_meals.php';
		   })});
	  </script>";
}
?>
<script language="javascript">
function check()
	{
		if(document.getElementById("reply").value==""){
			swal({
			  title: "失败！",
			  text: "回复信息不能为空！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("reply").focus();
			return false;
		}
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>订餐信息回复</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body class="add_news_body">
<!--订餐信息回复-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">订餐信息回复</h2>
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
    	<form name="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="password news_ab">回复信息：</span>
                    <span class="none"></span>
                    <textarea name='reply' id='reply'><?php echo mysql_result($query,$i,reply);?></textarea>
                </li>			
            </ul>
            <div class="bottom_box">
                <input type="submit" name="Submit" value="回复"  onclick="return check();" >
                <input type="reset" name="Submit2" value="重置"/>
                <input type="hidden" name="addnew" value="1" />
            </div>
        </form> 
        <?php
			}
		?>
    </div>
</div>
<!--订餐信息回复end-->
</body>
</html>

