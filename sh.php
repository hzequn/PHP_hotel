<?php
//验证登陆信息
include_once 'conn.php';
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
	$id=$_GET["id"];
	$yuan=$_GET["yuan"];
	$tablename=$_GET["tablename"];
	if($yuan == '是')
	{
		$comewhere=$_SERVER['HTTP_REFERER'];
		echo 
			"<script>
				$(function(){
					swal('警告！','已审核，无需再次审核','warning').then(() => {
						location.href='$comewhere';
				})});
			</script>";
	}
	else
	{
		$sql="update $tablename set issh='是' where id=$id";
		mysql_query($sql);
		$comewhere=$_SERVER['HTTP_REFERER'];
		echo 
			"<script>
				$(function(){
					swal('完成！','审核通过','success').then(() => {
						location.href='$comewhere';
				})});
			</script>";
	}
	 	
?>