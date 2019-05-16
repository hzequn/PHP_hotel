<?php
//验证登陆信息
include_once 'conn.php';
	$id=$_GET["id"];
	$room_id=$_GET['room_id'];
	$yuan=$_GET["yuan"];
	$issh=$_GET["issh"];
	$tablename=$_GET["tablename"];
	?>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
    <?php
	if($yuan=="是")//原状态已经退房的话就不能退房了
	{
		$comewhere=$_SERVER['HTTP_REFERER'];
		echo 
			"<script>
				$(function(){
					swal('警告！','客房此前已退房','warning').then(() => {
						location.href='$comewhere';
				})});
			</script>";
	}
	else
	{
		if($issh=="是"){//原状态未退房，并且已经审核后才可以退房
			$sql="update $tablename set `leave`='是' where id=$id";
			mysql_query($sql);
			$sql="select * from jiudianxinxi where id=$room_id";
			$query=mysql_query($sql);
			$number=mysql_result($query,0,number)+1;
			if($number!=0){
				$state=1;	
			}else{
				$state=0;
			}	
			$sql="update jiudianxinxi set number='$number',state='$state' where id=$room_id";
			mysql_query($sql);
			$sql="update $tablename set dizhi=$state where id=$id";
			mysql_query($sql);
			$comewhere=$_SERVER['HTTP_REFERER'];
			echo 
				"<script>
					$(function(){
						swal('成功！','成功退房','success').then(() => {
							location.href='$comewhere';
					})});
				</script>";
		}else{//未审核不可以退房
			$comewhere=$_SERVER['HTTP_REFERER'];
			echo 
				"<script>
					$(function(){
						swal('失败！','客房未审核，不可退房！','error').then(() => {
							location.href='$comewhere';
					})});
				</script>";
		}
		
	}
?>
