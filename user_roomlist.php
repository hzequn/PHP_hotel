<?php
session_start();
include_once 'conn.php';
$name=$_GET['name'];
$grade=$_GET['grade'];
$start=$_GET['price_start'];
$end=$_GET['price_end'];
$state=$_GET['state'];
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
    <!--背景图片-->
    <div class="roomlist_bg"></div>
    <!--背景图片end-->
    <!--房客信息-->
    <div class="hotel_msg content">
    	<form id="form1" name="form1" method="get" action="">
              <span>客房名称：</span>
              <input name="name" type="text" id="name" autocomplete="off" placeholder="请输入客房名称" style="width:150px" class="m_r_10" value="<?php echo $name;?>"/>
              <input type='text' style='display:none'> <!-- 针对firefox -->
              <span>客房星级：</span>
              <select name='grade' id='grade' class="m_r_10" value="<?php echo $grade;?>">
                <option value="">所有</option>
                <option value="五星级">五星级</option>
                <option value="四星级">四星级</option>
                <option value="三星级">三星级</option>
                <option value="二星级">二星级</option>
              </select>
              <span>客房价格：</span> 
              <input name="price_start" type="text" id="price_start" autocomplete="off" placeholder="请输入查询的最低价格" value="<?php echo $start;?>"/>&nbsp;-&nbsp;
              <input name="price_end" type="text" id="price_end" autocomplete="off" class="m_r_10" placeholder="请输入查询的最高价格" value="<?php echo $end;?>"/>
              <input type='text' style='display:none'> <!-- 针对firefox -->
              <span>客房状态：</span> 
               <select name='state' id='state' class="m_r_10" value="<?php echo $state;?>">
                <option value="">所有</option>
                <option value="0">0</option>
                <option value="1">1</option>
              </select>
              <input type="submit" name="Submit" value="查找" class="check_btn"/>
        </form>
            <?php 
				$sql="select * from jiudianxinxi where 1=1";
				if ($name!=""){
					$sql=$sql." and name like '%$name%'";
				}
				if ($grade!=""){
					$sql=$sql." and grade like '%$grade%'";
				}
				if ($start!=""){
					$selstart=(int)$start;
					$sql=$sql." and price >= $selstart";
				}
				if ($end!=""){
					$selend=(int)$end;
					$sql=$sql." and price <= $selend";
				}
				if ($state!=""){
					$sql=$sql." and state like '$state'";
				}
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
				  $pagelarge=10;//每页行数；
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
					
					?>
                    <table id="hotel_list" class="hotel_list table table-bordered table-hover">
                    <tr>
                        <th>序号</th>
                        <th>房客名称</th>
                        <th>星级</th>
                        <th>价格</th>
                        <th>剩余数量</th>
                        <th>图片</th>
                        <th>备注</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    <?php
					for($i=$pagecurrent*$pagelarge-$pagelarge;$i<$sum;$i++)
				{
					
				  ?>
                    <tr>
                      <td width="25"><?php echo $i+1;?></td>
                      <td><?php echo mysql_result($query,$i,name);?></td>
                      <td><?php echo mysql_result($query,$i,grade);?></td>
                      <td><?php echo mysql_result($query,$i,price);?></td>
                      <td class="<?php if(mysql_result($query,$i,number) == 1){ ?>only_text<?php }?>">
					  		<?php echo mysql_result($query,$i,number);?>
                      </td>
                      <td>
                          <a href="<?php echo mysql_result($query,$i,picture) ?>" target='_blank'>
                            <img src='<?php echo mysql_result($query,$i,picture) ?>' width='80' height='88' border='0'>
                          </a>
                      </td>
                      <td><?php echo mysql_result($query,$i,remarks);?></td>
                      <td><?php echo date('Y/m/d',strtotime(mysql_result($query,$i,"addtime")));?></td>
                      <td>
                         <a href="<?php if(mysql_result($query,$i,number) != 0){?>
                         	user_order.php?id=<?php echo mysql_result($query,$i,"id");?>"
                             <?php }else{?>"javascript:"<?php }?> class="<?php if(mysql_result($query,$i,number) == 0){?>full_room<?php }?>">
                            <?php if(mysql_result($query,$i,number) == 0){ ?> 
								满房
							<?php }else{?> 
								预订
                                <?php
								}
								?>
                          </a>
                     </td>
                    </tr>
                    <?php
					}
				}
				?>
    	</table>
         <!--分页导航-->
         <?php 
				$sql="select * from jiudianxinxi where 1=1";
				if ($name!=""){
					$sql=$sql." and name like '%$name%'";
				}
				if ($grade!=""){
					$sql=$sql." and grade like '%$grade%'";
				}
				if ($start!=""){
					$start=(int)$start;
					$sql=$sql." and price >= $start";
				}
				if ($end!=""){
					$end=(int)$end;
					$sql=$sql." and price <= $end";
				}
				if ($state!=""){
					$sql=$sql." and state like '$state'";
				}
				$sql=$sql." order by id desc";
				$query=mysql_query($sql);
				  $rowscount=mysql_num_rows($query);
				  if($rowscount > 10)
				  {
					?>
                    <div class="fenye">
                        <ul class="fpage clearfix" id="list_fpage">
                            <li><a href="user_roomlist.php?pagecurrent=1&name=<?php echo $name;?>&grade=<?php echo $grade;?>&price_start=<?php echo $start;?>&price_end=<?php echo $end;?>&state=<?php echo $state;?>">首页</a></li>
                            <li><a href="user_roomlist.php?pagecurrent=<?php echo $pagecurrent-1;?>&name=<?php echo $name;?>&grade=<?php echo $grade;?>&price_start=<?php echo $start;?>&price_end=<?php echo $end;?>&state=<?php echo $state;?>">上一页</a></li>
                            <li><a href="user_roomlist.php?pagecurrent=<?php echo $pagecurrent+1;?>&name=<?php echo $name;?>&grade=<?php echo $grade;?>&price_start=<?php echo $start;?>&price_end=<?php echo $end;?>&state=<?php echo $state;?>">下一页</a></li>
                            <li><a href="user_roomlist.php?pagecurrent=<?php echo $pagecount;?>&name=<?php echo $name;?>&grade=<?php echo $grade;?>&price_start=<?php echo $start;?>&price_end=<?php echo $end;?>&state=<?php echo $state;?>">尾页</a></li>
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
    <!--房客信息end-->
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
