<?php
session_start();
include_once 'conn.php';
extract($_POST);
extract($_GET);
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
$addnew=$_POST["addnew"];
$lb=$_GET["lb"];
?>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($addnew=="1" )
{
	$name=$_POST["name"];
	$cls=$_POST["cls"];
	$context=$_POST["context"];
	$picture=$_POST["picture"];
	$open=$_POST["open"];
	$personal=$_POST["personal"];
	$sql="insert into xinwentongzhi(name,cls,context,picture,open,personal) values('$name','$cls','$context','$picture','$open','$personal') ";
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','添加资讯信息','success').then(() => {
					location.href='check_news.php';
			})});
		</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>添加酒店优惠资讯</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<script language="javascript">
	function check(){
		if(document.getElementById("name").value==""){
			swal({
			  title: "失败！",
			  text: "请输入标题！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("cls").value==""){
			swal({
			  title: "失败！",
			  text: "请输入类别！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("cls").focus();
			return false;
		}
		if(document.getElementById("personal").value==""){
			swal({
			  title: "失败！",
			  text: "请输入添加人！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("personal").focus();
			return false;
		}
		if(document.getElementById("open").value==""){
			swal({
			  title: "失败！",
			  text: "请输入浏览次数！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("open").focus();
			return false;
		}
	}
	function uploadImg(){
		var url = "upfile.php";
		var data = new FormData($("#form1")[0])//序列化表单
		$.ajax({
			url: url,
			type: "POST",
			data:data,
			contentType:false,
			processData:false,//不序列化 data
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
<body class="add_news_body">
<!--添加酒店优惠资讯-->
<div class="add_news">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">添加酒店优惠资讯</h2>
        <p class="fr">当前日期： <?php echo $ndate; ?></p>
    </div>
    <div class="add_news_box">
    	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
            <ul>
                <li>
                    <span class="user">资讯标题：</span>
                    <input name='name' type='text' id='name' value='' autocomplete="off" placeholder="请输入标题"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">资讯类别：</span>
                    <input name='cls' type='text' id='cls' style="cursor:not-allowed" autocomplete="off" readonly value='<?php echo $lb;?>' />
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">浏览次数：</span>
                    <input name='open' type='text' id='open' value='' autocomplete="off" placeholder="请输入浏览次数"/>&nbsp;*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                <li>
                    <span class="password">添加人员：</span>
                    <input name='personal' type='text' id='personal' style="cursor:not-allowed" autocomplete="off" readonly value='<?php echo $_SESSION["username"]; ?>' />
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </li>
                 <li style="position:relative;">
                    <span class="password">展示图片：</span>
                    <input name='picture' type='text' id='picture' value='' readonly autocomplete="off" placeholder="点击上传图片" style="cursor:pointer;"/>
                    <input id="uploadImg" name="upfile" type="file" class="imgBtn" style="cursor:pointer;"/>
                </li>
                <li style="height:85px;">
                    <span class="password news_ab">资讯内容：</span>
                    <span class="none"></span>
                    <?php //$editor->Create();?><textarea name="context" placeholder="请输入资讯内容"></textarea>
                </li>
            </ul>
            <div class="bottom_box">
                <input type="submit" name="Submit" value="发布"  onclick="return check();" >
                <input type="reset" name="Submit2" value="重置"/>
                <input type="hidden" name="addnew" value="1" />
            </div>
        </form> 
    </div>
</div>
<!--添加酒店优惠资讯-->


</body>
</html>







