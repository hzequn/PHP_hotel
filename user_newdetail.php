<?php
session_start();
include_once 'conn.php';
$id=$_GET["id"];
mysql_query("update xinwentongzhi set open=open+1 where id=$id");
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
    <!--详细信息-->
    <div class="news_body content">
        <div class="com_top">
            <div class="">
                <h4 style="font-size:18px;">详细信息</h4>
            </div>
        </div>
        <div class="news_box">
         <?php 
			$sql="select * from xinwentongzhi where id=".$id;
			$query=mysql_query($sql);
			 $rowscount=mysql_num_rows($query);
			  if($rowscount==0)
			  {}
			  else
			  {
			?>
			 <h2><?php echo mysql_result($query,0,"name"); ?></h2>
            <div class="news_box_img">
            <img src="<?php echo mysql_result($query,0,"picture");?>" alt="<?php echo mysql_result($query,0,"name"); ?>" 				             title="<?php echo mysql_result($query,0,"name"); ?>"/>
            </div>
            <div class="news_box_text"><?php echo mysql_result($query,0,"context");?></div>
			<?php
                }
            ?>
        </div>
        
    </div>
<!--详细信息end-->

<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/swiper-3.4.2.jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
