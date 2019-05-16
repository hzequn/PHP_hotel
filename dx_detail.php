<?php
session_start();
include_once 'conn.php';
$lb=$_GET["lb"];
?>
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
    <div class="about_bg">
        <img src="img/about_bg.jpg" alt="酒店介绍图片" title="酒店介绍图片"/>
    </div>
	<!--图片end-->
    <!--酒店介绍-->
    <div class="hotel_tro content">
		<h4>酒店介绍</h4>
		<div class="text_con">
			<?php 
				$sql="select * from dx where leibie='酒店介绍'";
				$query=mysql_query($sql);
				 $rowscount=mysql_num_rows($query);
				  if($rowscount==0)
				  {}
				  else
				  {
				?>
					 <p><?php echo mysql_result($query,0,"content");?>
					 <?php
				}
			?>
            </p>
		</div>
	</div>
    <!--酒店介绍end-->
    <!--注册-->
    <div>
    	<?php include_once 'userreg.php';?>
    </div>
    <!--注册-->
    <script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/swiper-3.4.2.jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/index.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
