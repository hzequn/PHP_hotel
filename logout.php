<?php
//×¢ÏúµÇÂ¼
session_start();
$_SESSION['username']="";
$_SESSION['cx']="";
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
echo 
	"<script>
		$(function(){
			swal('×¢Ïú','ÒÑÍË³öµÇÂ¼','info').then(() => {
				location.href='index.php';
		})});
	</script>";
?>