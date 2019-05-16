<?php
//验证登陆信息
include_once 'conn.php';
?>
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<?php
$id=$_GET["id"];
$tablename=$_GET['tablename'];
$sql="delete from $tablename where id=$id";
mysql_query($sql);
$comewhere=$_SERVER['HTTP_REFERER'];
echo "<script language='javascript'>
	$(function(){
			swal('成功','删除数据','success').then(() => {
				location.href='".$_SERVER["HTTP_REFERER"]."';
		})});
	</script>";
?>