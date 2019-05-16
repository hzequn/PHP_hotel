<?php
session_start();
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if($_SESSION["username"]=="")
{
	echo 
		"<script>
			$(function(){
				swal('失败','请您先登录','error').then(() => {
					location.href='index.php';
			})});
		</script>";
	exit;
}
include_once 'conn.php';
$id=$_GET["id"];
$addnew=$_POST["addnew"];
if ($addnew=="1" )
{
	$zhanghao=$_POST["username1"];
	$zhaopian=$_POST["picture"];
	$xingming=$_POST["name"];
	$liuyan=$_POST["remarks"];
	$tel=$_POST["tel"];
	$address=$_POST["address"];
	$sql="insert into liuyanban(username,picture,name,remarks,address,tel) values('$username','$picture','$name','$remarks','$address','$tel') ";
	mysql_query($sql);
	echo 
		"<script>
			$(function(){
				swal('成功','预订餐饮','success').then(() => {
					location.href='user_foodlist.php';
			})});
		</script>";
}
?>
<script language="javascript">
	
	function check_food()
	{
		if(document.getElementById("tel").value==""){
			swal({
			  title: "失败！",
			  text: "请输入手机号！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("tel").focus();
			return false;
		}
		if(document.getElementById("address").value==""){
			swal({
			  title: "失败！",
			  text: "请输入配送地址！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("address").focus();
			return false;
		}
		if(document.getElementById("remarks").value==""){
			swal({
			  title: "失败！",
			  text: "请输入订餐信息！",
			  icon: "error",
			  showConfirmButton: true
         	})
			document.getElementById("remarks").focus();
			return false;
		}
		if($('#warning_tips1').html() != ""){
			swal({
			  title: "失败！",
			  text: "请输入正确的格式！",
			  icon: "error",
			  showConfirmButton: true
			})
			return false;
			document.getElementById("tel").value=="";
			document.getElementById("tel").focus();
		}
	}
</script>

<html>
<head>
<title>酒店管理信息系统</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/swiper-3.4.2.min.css" />
<link rel="stylesheet" href="css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
     <!--头部-->
        <div class="content"><?php include_once 'head_nav.php';?></div>
    <!--头部end-->
    <!--图片-->
    <div class="show_bg">
    	<img src="img/reservation_bg.jpg" title="餐饮预订" alt="餐饮预订"/>
    </div>
    <!--图片end-->
    <!--订餐面板-->
    <div class="sub_box">
        <div class="content">
            <h4>餐饮预订</h4>
            <form name="form1" method="post" action="">
            	<a href="user_foodlist.php" class="check_list">查看订餐列表</a>
                <div class="img clearfix">
                    <input name='picture' type='hidden' id='picture' value='<?php echo $_SESSION["zp"];?>' />
                    <span class="fl">头像：</span>
                    <p class="fl"><img src="<?php echo $_SESSION["zp"];?>"/></p>
                </div>
                <div class="user bg">
                    <span>账号：</span>
                    <input name='username1' readOnly="true" type='text' id='username1' value='<?php echo $_SESSION["username"];?>' />
                </div>
                <div class="user bg">
                    <span>姓名：</span>
                    <input name='name' readOnly="true" type='text' id='name' value='<?php echo $_SESSION["xm"];?>' />
                </div>
                <div class="user_border">
                    <span>手机：</span>
                    <input name='tel' type='text' id='tel' placeholder="请输入手机号" autocomplete="off"/>*
                    <input type='text' style='display:none'> <!-- 针对firefox -->
                </div>
                <div class="user">
                    <span class="address_state">房号：</span>
                    <span class="none"></span>
                    <textarea name='address' id='address' placeholder="请输入房间号"></textarea>*
                </div>
                <div class="user">
                    <span class="address_state">订餐：</span>
                    <span class="none"></span>
                    <textarea name='remarks' id='remarks' placeholder="请输入订餐信息"></textarea>*
                </div>
                <p id="warning_tips1" class="warning_tips1"></p>
                <div class="sub_submit">
                    <input type="hidden" name="addnew" value="1" />
                    <input type="submit" name="Submit" value="添加" onClick="return check_food();"/>
                    <input type="reset" name="Submit2" value="重置"/></td>
                </div>
            </form>
        </div>
    </div>
    <!--订餐面板end-->
    <!--注册登录-->
    <div>
    	<?php include_once 'userreg.php';?>
    </div>
    <!--注册登录-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/swiper-3.4.2.jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
<script>
	//手机号校验
	var telExp = /^(1[358][0-9]{9})$/;
　　$("#tel").keyup(function(){
		var $value=$(this).val();
		if(!telExp.test($value)){
			$('#warning_tips1').html("手机号码有误！");
			return false;
		}else{
			$('#warning_tips1').html("");
		}
　　}); 
</script>
</body>
</html>
