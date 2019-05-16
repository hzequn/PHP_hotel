<?php 
$id=$_GET["id"];
include_once 'conn.php';
extract($_POST);
extract($_GET);
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
$sql="select * from xinwentongzhi where id=".$id;
$query=mysql_query($sql);
$rowscount=mysql_num_rows($query);
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" )
{
	$calss=mysql_result($query,$i,cls);
	$name=$_POST["name"];
	$remarks=$_POST["remarks"];
	$picture=$_POST["picture"];
	$open=$_POST["open"];
	$personal=$_POST["personal"];
	$sql="update xinwentongzhi set name='$name',cls='$class',context='$remarks',picture='$picture',open='$open',personal='$personal' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','修改资讯信息','success').then(() => {
					location.href='check_news.php';
			})});
		</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>酒店优惠资讯修改</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body class="add_news_body">
<!--酒店优惠资讯修改-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">酒店优惠资讯修改</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
	$sql="select * from xinwentongzhi where id=".$id;
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
	{
	?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">资讯标题：</span>
                    <input name='name' type='text' id='name' autocomplete="off" value='<?php echo mysql_result($query,$i,name);?>'/>&nbsp;*	
                    <input type='text' style='display:none'> <!-- 针对firefox -->	
                </li>
                <li>
                    <span class="password">资讯类别：</span>
                    <input name='class' type='text' id='class' autocomplete="off" style="cursor:not-allowed" readonly value='<?php echo mysql_result($query,$i,cls);?>' />&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">浏览次数：</span>
                    <input name='open' type='text' id='open' autocomplete="off" value='<?php echo mysql_result($query,$i,open);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">添加人员：</span>
                    <input name='personal' type='text' id='personal' autocomplete="off" style="cursor:not-allowed"readonly  value='<?php echo mysql_result($query,$i,personal);?>'/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
 
                
                <li style="position:relative;">
                    <span class="password">展示图片：</span>
                    <input name='picture' type='text' id='picture' value="<?php echo mysql_result($query,$i,picture);?>" readonly autocomplete="off"  style="cursor:pointer;"/>
                    <input id="uploadImg" name="upfile" type="file" class="imgBtn" style="cursor:pointer;"/>
                </li>
                
                
                
				<li>
                	<span class="password news_ab">资讯内容：</span>
                    <span class="none"></span>
                    <textarea name="remarks" id="remarks" /><?php echo mysql_result($query,$i,context);?></textarea>
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
<!--酒店优惠资讯修改end-->
</body>
<script>
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
</html>

