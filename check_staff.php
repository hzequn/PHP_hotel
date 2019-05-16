<?php 
	include_once 'conn.php';
	$number=$_GET['number'];
	$name=$_GET['name'];
	$start_time=$_GET['start_time'];
	$end_time=$_GET['end_time'];
	$job=$_GET['job'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>员工信息列表</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/zane-calendar.css" />
</head>

<body class="check_news_body">
<!--员工信息列表-->
<div class="staff_list">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">已有酒店员工信息列表</h2>
        <?php 
			$sql="select * from yuangongxinxi where 1=1";
			$query=mysql_query($sql);
			$rowscount=mysql_num_rows($query);
		?>
        <p class="fr">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
    <p class=" all_del" id="all_del" onclick="deleteSelected()">批量删除</p>
    <form id="form1" name="form1" method="get" action="">
  		工号：<input name="number" type="text" id="number" style="width:113px;" autocomplete="off" placeholder="员工工号" value="<?php echo $number;?>"/>
        <input type='text' style='display:none'> <!-- 针对firefox -->
  		姓名：<input name="name" type="text" id="name" style="width:120px;" autocomplete="off" placeholder="员工姓名"value="<?php echo $name;?>"/> 
  		入职时间：<input name="start_time" type="text"  id="zane-calendar" readonly value='' style="width:160px;cursor:pointer;" autocomplete="off" placeholder="起时间" value="<?php echo $start_time;?>">&nbsp;—&nbsp;
        <input name="end_time" type="text"  value='' id="zane-calendar-2" readonly style="width:160px;cursor:pointer;" autocomplete="off" placeholder="始时间" value="<?php echo $end_time;?>"/> 
  		员工岗位：
      	<select name='job' id='job' <?php echo $job;?>>
        	<option value="">所有</option>
        	<option value="经理">经理</option>
        	<option value="厨师">厨师</option>
        	<option value="勤杂工">勤杂工</option>
        	<option value="服务员">服务员</option>
      	</select>
  		<input type="submit" name="Submit" value="查找" class="check_btn"/>
	</form>
    
  <?php 
    $sql="select * from yuangongxinxi where 1=1";
	if ($number!=""){
		$sql=$sql." and number like '%$number%'";
	}
	if ($name!=""){
		$sql=$sql." and name like '%$name%'";
	}
	if ($start_time!=""){
		$year=((int)substr($start_time,0,4));//取得年份
		$month=((int)substr($start_time,5,2));//取得月份
		$day=((int)substr($start_time,8,2));//取得几号
		$start=mktime(0,0,0,$month,$day,$year);
		$sql=$sql." and UNIX_TIMESTAMP(addtime) >= $start";
	}
	if ($end_time!=""){
		$year=((int)substr($end_time,0,4));//取得年份
		$month=((int)substr($end_time,5,2));//取得月份
		$day=((int)substr($end_time,8,2));//取得几号
		$end=mktime(0,0,0,$month,$day,$year);
		$sql=$sql." and UNIX_TIMESTAMP(addtime) <= $end";
	}
	if ($job!=""){
		$sql=$sql." and job like '%$job%'";
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
    <table class="table table-bordered table-hover">  
      <tr>
        <th><input type="checkbox" name="" id="checkall" value="" onclick="checkall();"/></th>
        <th>序号</th>
        <th>工号</th>
        <th>名称</th>
        <th>地址</th>
        <th>身份证号</th>
        <th>入职时间</th>
        <th>薪资</th>
        <th>工龄</th>
        <th>岗位</th>
        <th style="width:170px">备注</th>
        <th>操作</th>
      </tr>
	<?php
	for($i=$pagecurrent*$pagelarge-$pagelarge;$i<$sum;$i++)
	{
	  ?>
      <tr>
        <td><input type="checkbox" name="" id="" data-id="<?php echo mysql_result($query,$i,id);?>" value="" class="sel_btn"/></td>
        <td><?php echo $i+1;?></td>
        <td><?php echo mysql_result($query,$i,number);?></td>
        <td><?php echo mysql_result($query,$i,name);?></td>
        <td><?php echo mysql_result($query,$i,address);?></td>
        <td><?php echo mysql_result($query,$i,card);?></td>
        <td><?php echo date("Y-m-d",strtotime(mysql_result($query,$i,addtime)));?></td>
        <td><?php echo mysql_result($query,$i,price);?></td>
        <td><?php echo mysql_result($query,$i,age);?></td>
        <td><?php echo mysql_result($query,$i,job);?></td>
        <td><?php echo mysql_result($query,$i,remarks);?></td>
        <td>
            <a href="del.php?id=<?php echo mysql_result($query,$i,"id");?>&tablename=yuangongxinxi" onclick="return confirm('真的要删除？')">
                <i class="fa fa-trash b_r b_red material-icons m_b_5"></i>
                <span class="text_red">删除<span>
            </a> 
            <a href="update_staff.php?id=<?php echo mysql_result($query,$i,"id");?>">
                <i class="fa fa-pencil  b_r b_gree material-icons m_b_5"></i>
                <span class="text_gree">修改<span>
            </a> 
            <a href="detail_staff.php?id=<?php echo mysql_result($query,$i,"id");?>">
                <i class="fa fa-info  b_r b_blue material-icons m_b_5"></i>
                <span class="text_blue">详细<span>
            </a>
        </td>
      </tr>
		<?php
        }
    	}
    ?>
</table>
<?php 
    $sql="select * from yuangongxinxi where 1=1";
	if ($number!=""){
		$sql=$sql." and number like '%$number%'";
	}
	if ($name!=""){
		$sql=$sql." and name like '%$name%'";
	}
	if ($start_time!=""){
		$year=((int)substr($start_time,0,4));//取得年份
		$month=((int)substr($start_time,5,2));//取得月份
		$day=((int)substr($start_time,8,2));//取得几号
		$start=mktime(0,0,0,$month,$day,$year);
		$sql=$sql." and UNIX_TIMESTAMP(addtime) >= $start";
	}
	if ($end_time!=""){
		$year=((int)substr($end_time,0,4));//取得年份
		$month=((int)substr($end_time,5,2));//取得月份
		$day=((int)substr($end_time,8,2));//取得几号
		$end=mktime(0,0,0,$month,$day,$year);
		$sql=$sql." and UNIX_TIMESTAMP(addtime) <= $end";
	}
	if ($job!=""){
		$sql=$sql." and job like '%$job%'";
	}
	$sql=$sql." order by id desc";
	$query=mysql_query($sql);
  	$rowscount=mysql_num_rows($query);
  if($rowscount > 10)
	  {
		?>
		<div class="clearfix news_list_page">
			<p class="fl">
			  <input type="button" class="btn btn-info"" name="Submit2" onclick="javascript:window.print();" value="打印本页" />
			</p>
			<p class="fr news_list_page_p">
				<a href="check_staff.php?pagecurrent=1&number=<?php echo $number;?>&name=<?php echo $name;?>&start_time=<?php echo $start_time;?>&end_time=<?php echo $end_time;?>&job=<?php echo $job;?>">首页</a>
				<a href="check_staff.php?pagecurrent=<?php echo $pagecurrent-1;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&start_time=<?php echo $start_time;?>&end_time=<?php echo $end_time;?>&job=<?php echo $job;?>">上一页</a> 
				<a href="check_staff.php?pagecurrent=<?php echo $pagecurrent+1;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&start_time=<?php echo $start_time;?>&end_time=<?php echo $end_time;?>&job=<?php echo $job;?>">下一页</a>
				<a href="check_staff.php?pagecurrent=<?php echo $pagecount;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&start_time=<?php echo $start_time;?>&end_time=<?php echo $end_time;?>&job=<?php echo $job;?>">尾页</a>
				<span>第<?php echo $pagecurrent;?>页</span>
				<span>共<?php echo $pagecount;?>页</span>
				<span>共<?php echo $rowscount;?>条</span>
			</p>
		</div>
        <?php 
			}
		?>
</div>
<!--员工信息列表end-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/zane-calendar.js" type="text/javascript" charset="utf-8"></script>
<script src="js/zane-calendar-2.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
zaneDate({
    elem:'#zane-calendar',
    behindTop:5,
    width:258, 
    format: 'yyyy-MM-dd'
})
zaneDate({
    elem:'#zane-calendar-2',
    behindTop:5,
    width:258, 
    format: 'yyyy-MM-dd'
})
//全选操作
function checkall() {
    var checkall = document.getElementById("checkall");
    var checkedall = checkall.checked;
    var sel_btn = document.getElementsByClassName("sel_btn");
    if(checkedall) {
        //全选
        for(var i = 0; i < sel_btn.length; i++) {
            //设置复选框的选中状态
            sel_btn[i].checked = true;
        }
    } else {
        //取消全选
        for(var i = 0; i < sel_btn.length; i++) {
            sel_btn[i].checked = false;
        }
    }
}
function deleteSelected(){
    //获取选中数据的id
    var select_boxes = $(".sel_btn");
    var ids = new Array();
    for(var i = 0; i < select_boxes.length; i++){
        if(select_boxes[i].checked){
            ids.push($(select_boxes[i]).attr('data-id'));
        } 
}
    //将选中的id发送到php处理文件中实现删除
    $.ajax({
        url: "del_all.php",
        type: "post",
        data: {
            table: "yuangongxinxi",
            ids: ids
        },
        success: function(res){
            if(res.code == 0){//没有选择任何数据
            	swal({
                  title: "警告！",
                  text: "请选择删除的数据！",
                  icon: "warning",
                });
                return false;
           	}
            if(res.code == 1){//后台返回code状态1表示执行成功
            	swal({
                  title: "成功！",
                  text: "成功删除"+res.n+"条数据",
                  icon: "success",
                  showConfirmButton: true
                }).then ((isConfirm) => {//执行成功后的回调
                    history.go(0);
                })
           }    
        }
    })
}
</script>
</body>
</html>

