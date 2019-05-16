<?php 
include_once 'conn.php';
$user=$_GET['user'];
$name=$_GET['name'];
$agree=$_GET['agree'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>用户注册信息列表</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<link rel="stylesheet" href="css/demo_add.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body class="check_news_body">
<!--注册用户信息列表-->
<div class="staff_list">
	<div class="clearfix admin_con_top">
    	<h2 class="fl">已有注册信息列表</h2>
        <?php 
			$sql="select * from yonghuzhuce where 1=1";
			$query=mysql_query($sql);
			$rowscount=mysql_num_rows($query);
		?>
        <p class="fr">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
    <div class="clearfix m_b_10">
    	<p class="all_del" id="all_del" onclick="undoSelected()">批量停用</p>
        <form id="form1" name="form1" method="get" action="" class="fr">
            账号：<input name="user" type="text" id="user" class="m_r_10 p_l_6" autocomplete="off"  placeholder="账号" value="<?php echo $user;?>"/>
            <input type='text' style='display:none' /> <!-- 针对firefox -->
            姓名：<input name="name" type="text" id="name" class="m_r_10 p_l_6" autocomplete="off" placeholder="姓名" value="<?php echo $name;?>"/>
            是否审核：
            <select name='agree' id='agree' style="text-align:center;width:80px;height:30px;" class="m_r_10" placeholder="是否审核" value="<?php echo $agree;?>">
                <option value="">所有</option>
                <option value="是">是</option>
                <option value="否">否</option>
            </select>
            <input type="submit" name="Submit" value="查找" class="check_btn"/>
        </form>
    </div>
  <?php 
    $sql="select * from yonghuzhuce where 1=1";
	if ($user!=""){
		$sql=$sql." and zhanghao like '%$user%'";
	}
	if ($name!=""){
		$sql=$sql." and xingming like '%$name%'";
	}
	if ($agree!=""){
		$sql=$sql." and issh like '$agree'";
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
        <th>姓名</th>
        <th>账号</th>
        <th class="user_img">头像</th>
        <th>性别</th>
        <th>家庭地址</th>
        <th>email</th>
        <th>是否审核</th>
        <th>是否停用</th>
        <th>添加时间</th>
        <th>操作</th>
      </tr>
	<?php
	for($i=$pagecurrent*$pagelarge-$pagelarge;$i<$sum;$i++)
	{
	  ?>
	  <tr>
		<td><input type="checkbox" name="" id="" data-id="<?php echo mysql_result($query,$i,id);?>" value="" class="sel_btn"/></td>
		<td><?php echo $i+1;?></td>
		<td><?php echo mysql_result($query,$i,xingming);?></td>
		<td><?php echo mysql_result($query,$i,zhanghao);?></td>
		<td><img class="user_tar" src="<?php echo mysql_result($query,$i,zhaopian);?>"></td>
		<td><?php echo mysql_result($query,$i,xingbie);?></td>
		<td><?php echo mysql_result($query,$i,diqu);?></td>
		<td><?php echo mysql_result($query,$i,Email);?></td>
		<td><?php echo mysql_result($query,$i,issh);?></td>
        <td><?php echo mysql_result($query,$i,undo);?></td>
		<td><?php echo date('Y/m/d',strtotime(mysql_result($query,$i,addtime)));?></td>
		<td>
        	<a href="sh.php?id=<?php echo mysql_result($query,$i,'id');?>&amp;yuan=<?php echo mysql_result($query,$i,issh);?>&tablename=yonghuzhuce" <?php if(mysql_result($query,$i,issh) == '否'){ ?>onclick="return confirm('确定审核？')"<?php }?>>
				<i class="fa fa-check b_r b_gree material-icons m_b_5"></i>
				<span class="text_gree">审核<span>
			</a>
			<a href="<?php if(mysql_result($query,$i,undo) == '否'){?>undo.php?id=<?php echo mysql_result($query,$i,'id');?>&tablename=yonghuzhuce<?php }else{?>indo.php?id=<?php echo mysql_result($query,$i,'id');?>&tablename=yonghuzhuce<?php }?>" <?php if(mysql_result($query,$i,undo) == '否'){ ?>onclick="return confirm('真的要停用？')"<?php }?>>
				<i class="fa b_r material-icons m_b_5 <?php if(mysql_result($query,$i,undo) == '否'){?>fa-ban b_red<?php }else{?>fa-star b_open<?php }?>"></i>
				<span class="<?php if(mysql_result($query,$i,undo) == '否'){?>text_red<?php }else{?>text_open<?php }?>"><?php if(mysql_result($query,$i,undo) == '否'){?>停用<?php }else{?>启用<?php }?><span>
			</a>
			<a href="update_user.php?id=<?php echo mysql_result($query,$i,id);?>">
				<i class="fa fa-pencil b_r b_blue material-icons"></i>
				<span class="text_blue">修改<span>
			</a>
		</td>
	  </tr>
		<?php
		}
	}
	?>
</table>
<?php 
  if($rowscount > 10)
  {
	  ?>
        <div class="clearfix news_list_page">
            <p class="fl">
              <input type="button" class="btn btn-info"" name="Submit2" onclick="javascript:window.print();" value="打印本页" />
            </p>
            <p class="fr news_list_page_p">
                <a href="check_user.php?pagecurrent=1&user=<?php echo $user;?>&name=<?php echo $name;?>&agree=<?php echo $agree;?>">首页</a>
                <a href="check_user.php?pagecurrent=<?php echo $pagecurrent-1;?>&user=<?php echo $user;?>&name=<?php echo $name;?>&agree=<?php echo $agree;?>">上一页</a> 
                <a href="check_user.php?pagecurrent=<?php echo $pagecurrent+1;?>&user=<?php echo $user;?>&name=<?php echo $name;?>&agree=<?php echo $agree;?>">下一页</a>
                <a href="check_user.php?pagecurrent=<?php echo $pagecount;?>&user=<?php echo $user;?>&name=<?php echo $name;?>&agree=<?php echo $agree;?>">尾页</a>
                <span>第<?php echo $pagecurrent;?>页</span>
                <span>共<?php echo $pagecount;?>页</span>
                <span>共<?php echo $rowscount;?>条</span>
            </p>
        </div>
        <?php }?>
</div>
<!--注册用户信息列表end-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script>
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
function undoSelected(){
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
        url: "undo_all.php",
        type: "post",
        data: {
            table: "yonghuzhuce",
            ids: ids
        },
        success: function(res){
            if(res.code == 0){//没有选择任何数据
            	swal({
                  title: "警告！",
                  text: "请选择停用的用户！",
                  icon: "warning",
                });
                return false;
           	}
            if(res.code == 1){//后台返回code状态1表示执行成功
            	if(res.n ==0){
                  swal({
                      title: "失败！",
                      text: "用户本身已停用",
                      icon: "error",
                      showConfirmButton: true
                    }).then ((isConfirm) => {//执行成功后的回调
                        history.go(0);
                    })
                }else{
                	swal({
                      title: "成功！",
                      text: "成功停用"+res.n+"个用户,"+"失败停用"+res.m+"个用户",
                      icon: "success",
                      showConfirmButton: true
                    }).then ((isConfirm) => {//执行成功后的回调
                        history.go(0);
                    })
                }
           }    
        }
    })
}
</script>
</body>
</html>

