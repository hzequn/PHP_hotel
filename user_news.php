<?php
session_start();
include_once 'conn.php';
$lb=$_GET["lb"];
$name=$_GET["name"];
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
	<!--图片-->
    <div class="about_bg">
        <img src="img/hotel_bg.jpg" alt="酒店优惠图片" title="酒店优惠图片"/>
    </div>
	<!--图片end-->
    <!--酒店优惠列表-->
    <div class="news_list content">
        <div class="com_top clearfix">
            <div class="fl">
                <h4>酒店优惠</h4>
                <p>HOTEL DISCOUNT</p>
            </div>
            <div class="fr sesarch">
            	<div class="search_box">
                	<form action="user_news.php" method="get" name="formsearch" id="formsearch">
                    	<input type="text" name="name" class="input fl" id="name" value="<?php echo $name;?>" placeholder="请输入酒店优惠名称" autocomplete="off">
                        <input type='text' style='display:none'> <!-- 针对firefox -->
                        <input type="submit" class="btnimg fl" id="btn" src="img/glass.png">
                    </form>				
				</div>
            </div>
        </div>
        <ul class="news_list_ul">
        <?php 
        $sql="select * from xinwentongzhi where 1=1";
        if ($name!=""){
			$sql=$sql." and name like '%$name%'";
		}
        if($lb!=""){
			$sql=$sql." and cls='$lb'";
		}
          $sql=$sql." order by id desc";
          $query=mysql_query($sql);
          $rowscount=mysql_num_rows($query);
          if($rowscount==0)
          {
			 ?>
             <div class="date_null">抱歉，您的搜索结果为空。</div>
             <?php
			}
          else
          {
          $pagelarge=8;//每页行数;
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
                 <a href="user_newdetail.php?id=<?php echo mysql_result($query,$i,"id");?>" class="clearfix">
                    <div class="img fl">
                        <img src="<?php echo mysql_result($query,$i,"picture");?>" alt="<?php echo mysql_result($query,$i,"name");?>" title="<?php echo mysql_result($query,$i,"name");?>">
                    </div>
                    <div class="news_con fl">
                        <div>
                            <span class="rank"><?php echo ($i + 1)?></span>
                            <span class="name txt_overflow"><?php echo mysql_result($query,$i,"name");?></span>
                            <span class="clsname"><?php echo mysql_result($query,$i,"cls");?></span>
                        </div>
                        <p class="pname txt_news_pname"><?php echo mysql_result($query,$i,"context");?></p>
                        <div class="clearfix">
                            <p class="fl">发布时间：<?php echo date('Y-m-d',strtotime(mysql_result($query,$i,"addtime")));?></p>
                            <p class="fl">浏览次数：<?php echo mysql_result($query,$i,"open");?></p>   
                        </div>
                    </div>
                 </a>
               </li>
                <?php
                }
              }
              ?>
        </ul>
        <!--分页导航-->
        <?php 
		$sql="select * from xinwentongzhi where 1=1";
        if ($name!=""){
			$sql=$sql." and name like '%$name%'";
		}
		$sql=$sql." order by id desc";
        $query=mysql_query($sql);
          $rowscount=mysql_num_rows($query);
          if($rowscount > 8)
          {
		?>
        <div class="fenye">
            <ul class="fpage clearfix" id="list_fpage">
            	<li><a href="user_news.php?pagecurrent=1&lb=<?php echo $lb;?>&name=<?php echo $name;?>">首页</a></li>
                <li><a href="user_news.php?pagecurrent=<?php echo $pagecurrent-1;?>&lb=<?php echo $lb;?>&name=<?php echo $name;?>">上一页</a></li>
                <li><a href="user_news.php?pagecurrent=<?php echo $pagecurrent+1;?>&lb=<?php echo $lb;?>&name=<?php echo $name;?>">下一页</a></li>
                <li><a href="user_news.php?pagecurrent=<?php echo $pagecount;?>&lb=<?php echo $lb;?>&name=<?php echo $name;?>">尾页</a></li>
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
    <!--酒店优惠列表end-->
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
