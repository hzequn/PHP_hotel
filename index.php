<?php
session_start();
include_once 'conn.php';
?>
<html>
<head>
<title>酒店管理信息系统</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/swiper-3.4.2.min.css" />
<link rel="stylesheet" href="css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body>
    <!--头部-->
    <div class="content"><?php include_once 'head_nav.php';?></div>
    <!--头部end-->
	<!--轮播图-->
	<div class="banner" id="banner">
		<div id="myCarousel" class="carousel slide imgbox" id="bannerimg">
			<!-- 轮播（Carousel）指标 -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to='0' class="active"></li>
				<li data-target="#myCarousel" data-slide-to='1' class=""></li>
				<li data-target="#myCarousel" data-slide-to='2' class=""></li>
			</ol>   
			<!-- 轮播（Carousel）项目 -->
			<div class="carousel-inner">
				<div class="item active"><img src="img/banner01.jpg" alt="轮播图1" title="轮播1"></div>
				<div class="item"><img src="img/banner02.jpg" alt="轮播图2" title="轮播2"></div>
				<div class="item"><img src="img/banner03.jpg" alt="轮播图3" title="轮播3"></div>
			</div>
		</div> 
	</div>
	<!--轮播图end-->
    <!--酒店优惠-->
	<div class="hotel_show content">
		<div class="com_top clearfix">
			<div class="fl">
				<h4>酒店优惠</h4>
				<p>HOTEL DISCOUNT</p>
			</div>
			<div class="fr sesarch">
            	<div class="search_box">
                	<form action="user_news.php" method="post" name="formsearch" id="formsearch">
                    	<input type="text" name="name" class="input fl" id="name" placeholder="请输入酒店优惠名称" autocomplete="off">
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                        <input type="submit" class="btnimg fl" id="btn" src="img/glass.png">
                    </form>				
				</div>
            </div>
		</div>
		<div class="con_box clearfix">
			<ul class="hotel_show_ul clearfix">
				<!--酒店优惠新闻数据-->
                 <?php 
					  $sql="select name,id,addtime,context,picture from xinwentongzhi where cls='酒店优惠' order by id desc";
					  $query=mysql_query($sql);
					  $rowscount=mysql_num_rows($query);
					  if($rowscount>0)
					  {
					  	for($i=0;$i<$rowscount;$i++)
						{
							if($i==6)
							{
								break ;
							}
						?>
                        <li class="clearfix">    
                                <div class="img fl"><img src="<?php echo mysql_result($query,$i,"picture");?>" alt="<?php echo mysql_result($query,$i,"name");?>" title="<?php echo mysql_result($query,$i,"name");?>"></div>
                                <div class="con fl">
                                	<div class="title_top clearfix">
                                    	<h4 class="fl"><a href="user_newdetail.php?id=<?php echo mysql_result($query,$i,"id");?>" class="txt_overflow"><?php echo mysql_result($query,$i,"name");?></a></h4>
                                        <p class="fl titme"><?php echo date('Y-m-d',strtotime(mysql_result($query,$i,"addtime")));?></p>
                                    </div>
                                    <div class="con_bottom txt_con_bottom"><?php echo mysql_result($query,$i,"context");?></div>
                                    <a href="user_newdetail.php?id=<?php echo mysql_result($query,$i,"id");?>" class="more">查看详情</a>
                                </div>  
                        </li> 
                              <?php
						}
					  }
					  ?>          
                <!--酒店新闻数据end-->
			</ul>
            <a href="user_news.php?lb=酒店优惠" class="check_more">查看更多</a>
		</div>
	</div>
	<!--酒店优惠end-->
    <!--房客信息-->
    <div class="room_msg content">
    	<div class="com_top clearfix">
			<div class="fl">
				<h4>客房信息</h4>
				<p>GUEST ROOM</p>
			</div>
            <a href="user_roomlist.php"> >>更多</a>
		</div>
		<div class="swiper-container">
		    <div class="swiper-wrapper">
				<?php $sql="select * from jiudianxinxi where picture<>''";
          		$sql=$sql." order by id desc";
          		$query=mysql_query($sql);
          		$rowscount=mysql_num_rows($query);
             	for($i=0;$i<$rowscount;$i++)
        			{
            			if($i<=5)
            		{
          		?>
                <div class="swiper-slide" id="room_slide">
                	<a href="<?php echo mysql_result($query,$i,"picture");?>">
                    	<div class="img"><img src="<?php echo mysql_result($query,$i,"picture");?>" alt="<?php echo mysql_result($query,$i,"name");?>" title="<?php echo mysql_result($query,$i,"name");?>"/></div>
		        		<p class="name"><?php echo mysql_result($query,$i,"name");?></p>
                    </a>
                </div>
                <?php
                 }
            	}
          	?>
		    </div>
		</div>
	</div>
    <!--房客信息end-->
    
    <!--酒店介绍-->
    <div class="hotel_tro content">
		<div class="com_top clearfix">
			<div class="fl">
				<h4>酒店介绍</h4>
				<p>Hotel Introduction</p>
			</div>
		</div>
		<div class="text_con">
			<?php 
				$sql="select * from dx where leibie='酒店介绍'";
				$query=mysql_query($sql);
				 $rowscount=mysql_num_rows($query);
				  if($rowscount==0)
				  {?>
					  <div class="date_null">暂无酒店介绍</div>
				  <?php }
				  else
				  {
				?>
					 <p><?php echo mysql_result($query,0,"content");?>
					 <?php
				}
			?>
            </p>
		</div>
		<ul class="hotel_tro_ul clearfix">
			<li><img src="img/about_img0.jpg" alt="酒店介绍图片1" title="酒店介绍图片1"/></li>
            <li><img src="img/about_img1.jpg" alt="酒店介绍图片2" title="酒店介绍图片2"/></li>
            <li><img src="img/about_img2.jpg" alt="酒店介绍图片3" title="酒店介绍图片3"/></li>
            <li><img src="img/about_img3.jpg" alt="酒店介绍图片4" title="酒店介绍图片4"/></li>
		</ul>
	</div>
    <!--酒店介绍end-->
    <!--注册登录-->
    <div>
    	<?php include_once 'userreg.php';?>
    </div>
    <!--注册登录-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/swiper-3.4.2.jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
