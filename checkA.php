<?php
//在需要验证管理员身份的地方引用
session_start();
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
if ($_SESSION['username']==""){
	echo 
		"<script>
			$(function(){
				swal('警告','非法操作','warning').then(() => {
					location.href='login.php';
			})});
		</script>";
}
?>