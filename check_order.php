<?php 
include_once 'conn.php';
$number=$_GET['number'];
$name=$_GET['name'];
$card=$_GET['card'];
$leave=$_GET['leave'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>客户入住信息列表</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body class="check_news_body">
<!--员工信息列表-->
<div class="staff_list">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">已有入住信息列表</h2>
        <?php 
			$sql="select * from ruzhuxinxi where 1=1";
			$query=mysql_query($sql);
			$rowscount=mysql_num_rows($query);
		?>
        <p class="fr">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
    <p class="all_del" id="all_del" onclick="deleteSelected()">批量删除</p>
    <form id="form1" name="form1" method="get" action="">
  		房间号：<input name="number" type="text" id="number" style="width:170px"  autocomplete="off" placeholder="请输入房间号" value="<?php echo $number;?>" /> 
        <input type='text' style='display:none'> <!-- 针对firefox -->
  		客户姓名：<input name="name" type="text" id="name" style="width:170px" autocomplete="off" placeholder="请输入客户姓名" value="<?php echo $name;?>" />
         <input type='text' style='display:none'> <!-- 针对firefox -->
  		身份证号：<input name="card" type="text" id="card" style="width:210px" autocomplete="off" placeholder="请输入身份证号" value="<?php echo $card;?>" />
        <input type='text' style='display:none'> <!-- 针对firefox -->
        是否退房：
        <select name='leave' id='leave' style="text-align:center;" value=<?php echo $leave;?>>
              <option value="">所有</option>
              <option value="是">是</option>
              <option value="否">否</option>
        </select>
  		<input type="submit" name="Submit" value="查找" class="check_btn" />
	</form>
    
  <?php 
    $sql="select * from ruzhuxinxi where 1=1";
	if ($number!=""){
		$sql=$sql." and number like '%$number%'";
	}
	if ($name!=""){
		$sql=$sql." and name like '%$name%'";
	}
	if ($card!=""){
		$sql=$sql." and card like '%$card%'";
	}
	if ($leave!=""){
		$sql=$sql." and `leave` like '$leave'";
	}
	$sql=$sql." order by id desc";
	$query=mysql_query($sql);
  	$rowscount=mysql_num_rows($query);
	  if($rowscount == 0)
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
            <th>房间号</th>
            <th>姓名</th>
            <th>身份证号</th>
            <th>价格</th>
            <th>入住时间</th>
            <th>是否退房</th>
            <th>备注</th>
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
		<td><?php echo mysql_result($query,$i,card);?></td>
		<td><?php echo mysql_result($query,$i,price);?></td>
		<td><?php echo date('Y/m/d',strtotime(mysql_result($query,$i,addtime)));?></td>
        <td><?php echo mysql_result($query,$i,leave);?></td>
		<td><?php echo mysql_result($query,$i,remarks);?></td>
		<td>
			<a href="del.php?id=<?php echo mysql_result($query,$i,id);?>&tablename=ruzhuxinxi" onclick="return confirm('真的要删除？')">
				<i class="fa fa-trash b_r b_red material-icons m_b_5"></i>
				<span class="text_red">删除<span>
			</a> 
			<a href="<?php if(mysql_result($query,$i,leave) == '是'){?>javascript:;<?php }else{?>update_order.php?id=<?php echo mysql_result($query,$i,id);?><?php }?>">
				<i class="fa fa-pencil  b_r material-icons m_b_5 <?php if(mysql_result($query,$i,leave) == '是'){?>b_ccc<?php }else{?>b_gree<?php }?>"></i>
				<span class="<?php if(mysql_result($query,$i,leave) == '是'){?>text_ccc<?php }else{?>text_gree<?php }?>">修改<span>
			</a> 
			<a href="<?php if(mysql_result($query,$i,leave) == '是'){?>javascript:;<?php }else{?>leave_order.php?id=<?php echo mysql_result($query,$i,id);?>&amp;yuan=<?php echo mysql_result($query,$i,leave);?>&tablename=ruzhuxinxi<?php }?>">
				<i class="fa fa-sign-out b_r material-icons m_b_5 <?php if(mysql_result($query,$i,leave) == '是'){?>b_ccc<?php }else{?>b_blue<?php }?>"></i>
				<span class="<?php if(mysql_result($query,$i,leave) == '是'){?>text_ccc<?php }else{?>text_blue<?php }?>">退房<span>
			</a>
        </a>
		</td>
	  </tr>
		<?php
		}
	}
	?>
</table>
<?php 
    $sql="select * from ruzhuxinxi where 1=1";
	if ($number!=""){
		$sql=$sql." and number like '%$number%'";
	}
	if ($name!=""){
		$sql=$sql." and name like '%$name%'";
	}
	if ($card!=""){
		$sql=$sql." and card like '%$card%'";
	}
	if ($leave!=""){
		$sql=$sql." and `leave` like '$leave'";
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
                <a href="check_order.php?pagecurrent=1&number=<?php echo $number;?>&name=<?php echo $name;?>&card=<?php echo $card;?>&leave=<?php echo $leave;?>">首页</a>
                <a href="check_order.php?pagecurrent=<?php echo $pagecurrent-1;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&card=<?php echo $card;?>&leave=<?php echo $leave;?>">上一页</a> 
                <a href="check_order.php?pagecurrent=<?php echo $pagecurrent+1;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&card=<?php echo $card;?>&leave=<?php echo $leave;?>">下一页</a>
                <a href="check_order.php?pagecurrent=<?php echo $pagecount;?>&number=<?php echo $number;?>&name=<?php echo $name;?>&card=<?php echo $card;?>&leave=<?php echo $leave;?>">尾页</a>
                <span>第<?php echo $pagecurrent;?>页</span>
                <span>共<?php echo $pagecount;?>页</span>
                <span>共<?php echo $rowscount;?>条</span>
            </p>
        </div>
        <?php }?>
</div>
<!--员工信息列表end-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript" >
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
            table: "ruzhuxinxi",
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

