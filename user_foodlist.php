<?php
session_start();
include_once 'conn.php';
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
    <div class="about_bg hotel_list">
        <img src="img/hotel_list.jpg" alt="餐饮预订图片" title="餐饮预订图片"/>
    </div>
	<!--图片end-->
    <!--订餐列表-->
    <div class="orde_list content">
    	<h4>我的预订列表</h4>
        <a href="user_food.php">去订餐>></a>
        <ul class="orde_list_ul">
		<?php
            $sql="select * from liuyanban where username='".$_SESSION['username']."'";
            $sql=$sql." order by id desc";
            $query=mysql_query($sql);
             $rowscount=mysql_num_rows($query);
             if($rowscount==0)
			  {
			  ?>
				<div class="date_null">抱歉，您的查询结果为空</div>
			 	<?php
				}
			  else
			  {
			  $pagelarge=5;//每页行数；
			  $pagecurrent=$_GET["pagecurrent"];
			  if($rowscount%$pagelarge==0)
			  	{
					$pagecount=$rowscount/$pagelarge;
			  	}
			  else
				{
					$pagecount=intval($rowscount/$pagelarge)+1;
				 }
			  if($pagecurrent=="" || $pagecurrent<=0)
				{
					$pagecurrent=1;
				}
			 
			if($pagecurrent>$pagecount)
				{
					$pagecurrent=$pagecount;
				}
					$sum=$pagecurrent*$pagelarge;
				if($pagecurrent==$pagecount)
				{
					if($rowscount%$pagelarge==0)
					{
					$sum=$pagecurrent*$pagelarge;
					}
					else
					{
					$sum=$pagecurrent*$pagelarge-$pagelarge+$rowscount%$pagelarge;
					}
				}
				for($i=$pagecurrent*$pagelarge-$pagelarge;$i<$sum;$i++)
					{
					 ?>
                     	<li>
                            <ul class="list_msg">
                                <li>
                                	<span>账号：<?php echo mysql_result($query,$i,"username");?></span>
                                    <span>姓名：<?php echo mysql_result($query,$i,"name");?></span>
                                </li>
                                <li>订单信息：<?php echo mysql_result($query,$i,"remarks");?></li>
                                <li>下单时间：<?php echo mysql_result($query,$i,"addtime");?></li>
                                <li>联系方式：<?php echo mysql_result($query,$i,"tel");?></li>
                                <li>配送地址：<?php echo mysql_result($query,$i,"address");?></li>
                            </ul>
                            <div class="orde_list_bottom">店家回复：<?php echo mysql_result($query,$i,"reply");?></div>
                        </li>
                     <?php
					}
  				}
 				?>
        </ul>
        <!--分页导航-->
        <?php
            $sql="select * from liuyanban where username='".$_SESSION['username']."'";
            $sql=$sql." order by id desc";
            $query=mysql_query($sql);
             $rowscount=mysql_num_rows($query);
             if($rowscount > 5)
			  {
			  ?>
                <div class="fenye">
                    <ul class="fpage clearfix" id="list_fpage">
                        <li><a href="user_foodlist.php?pagecurrent=1">首页</a></li>
                        <li><a href="user_foodlist.php?pagecurrent=<?php echo $pagecurrent-1;?>">上一页</a></li>
                        <li><a href="user_foodlist.php?pagecurrent=<?php echo $pagecurrent+1;?>">下一页</a></li>
                        <li><a href="user_foodlist.php?pagecurrent=<?php echo $pagecount;?>">尾页</a></li>
                        <li>第<?php echo $pagecurrent;?>页</li>
                        <li>共<?php echo $pagecount;?>页</li>
                        <li>共<?php echo $rowscount;?>条</li>
                    </ul>	
                </div>
        	<?php
			  }
			?>
        <!--分页导航end-->
    </div>
    <!--订餐列表end-->
    <!--注册登录-->
    <div>
    	<?php include_once 'userreg.php';?>
    </div>
    <!--注册登录-->
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/swiper-3.4.2.jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
