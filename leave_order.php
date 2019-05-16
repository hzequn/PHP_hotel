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
	if($yuan=="是")
	{
		$comewhere=$_SERVER['HTTP_REFERER'];
		echo 
			"<script>
				   $(function(){
					swal('失败','客房之前已经退房了','error').then(() => {
					 location.href='$comewhere';
				   })});
			  </script>";
	}
	else
	{
		$sql="update $tablename set `leave`='是' where id=$id";
		mysql_query($sql);
		$comewhere=$_SERVER['HTTP_REFERER'];
		echo 
			"<script>
				   $(function(){
					swal('成功','退房成功！','success').then(() => {
					 location.href='$comewhere';
				   })});
			  </script>";
	}
?>
