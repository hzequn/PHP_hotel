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
	$name=$_POST["name"];
	$grade=$_POST["grade"];
	$price=$_POST["price"];
	$picture=$_POST["picture"];
	$remarks=$_POST["remarks"];
	$number=$_POST['number'];
	$sql="update jiudianxinxi set name='$name',grade='$grade',price='$price',number='$number',picture='$picture',remarks='$remarks' where id= ".$id;
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','修改客房信息','success').then(() => {
					location.href='check_room.php';
			})});
		</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>修改客房信息</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body class="add_news_body">
<!--客房信息修改-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">客房信息修改</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    <?php
	$sql="select * from jiudianxinxi where id=".$id;
	$query=mysql_query($sql);
	$rowscount=mysql_num_rows($query);
	if($rowscount>0)
	{
	?>		
    	<form id="form1" name="form1" method="post" action="">
            <ul>
                <li>
                    <span class="user">客房名称：</span>
                    <input name='name' type='text' id='name' value='<?php echo mysql_result($query,$i,name);?>' autocomplete="off"/>&nbsp;*	
                    <input type='text' style='display:none'> <!-- 针对firefox -->	
                </li>
                <li>
                    <span class="password">客房星级：</span>
                    <select name='grade' id='grade'>&nbsp;*
                          <option value="五星级">五星级</option>
                          <option value="四星级">四星级</option>
                          <option value="三星级">三星级</option>
                          <option value="二星级">二星级</option>
                    </select>
                </li>
                <li>
                    <span class="password">客房价格：</span>
                    <input name='price' type='text' id='price' value='<?php echo mysql_result($query,$i,price);?>' autocomplete="off"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>

                <li>
                    <span class="password">剩余数量：</span>
                    <input name='number' type='text' id='number' value='<?php echo mysql_result($query,$i,number);?>' autocomplete="off"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
               <li style="position:relative;">
                    <span class="password">客房图片：</span>
                    <input name='picture' type='text' id='picture'  readonly autocomplete="off" value="<?php echo mysql_result($query,$i,picture);?>" style="cursor:pointer;"/>
                    <input id="uploadImg" name="upfile" type="file" class="imgBtn" style="cursor:pointer;"/>
                </li>
				<li>
                	<span class="password news_ab">客房备注：</span>
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
<!--客房信息修改end-->
<script language="javascript">
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
</body>
</html>

