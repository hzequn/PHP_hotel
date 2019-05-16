<?php 
include_once 'conn.php';
extract($_POST);
extract($_GET);
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
$addnew=$_GET["addnew"];
if ($addnew=="1" )
{
	$sql="update dx set content='$content' where leibie= '酒店介绍'";
	mysql_query($sql);
	echo "<script>javascript:alert('操作成功!');location.href='introduce.php?lb='酒店介绍'';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>酒店介绍修改</title>
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link href="css/froala_editor.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body class="add_news_body">
	<!--酒店介绍信息修改-->
    <div class="tro_box">
        <div class="clearfix admin_con_top">
            <h2 class="fl">酒店介绍信息修改</h2>
            <p class="fr">当前日期： <?php echo $ndate; ?></p>
        </div>
        <?php
			$sql="select * from dx where leibie='酒店介绍'";
			$query=mysql_query($sql);
			$rowscount=mysql_num_rows($query);
			if($rowscount>0)
			{
			?>
			<form id="form1" name="form1" method="get" action="">
				<script id="container" name="content" type="text/plain"><?php echo mysql_result($query,0,content);?></script>
				<div style="width:161px;margin:0 auto;margin-top:10px;">
					<input type="submit" name="Submit" value="确定发布" id="btn_submit" class="btn btn-success" style="margin-right:20px;"/>
					<input type="reset" name="Submit2" value="重置" class="btn btn-primary"/>
					<input name="addnew" type="hidden" id="addnew" value="1" />           
				</div>            
			</form>
			<?php
			}
			?> 
    </div>
	<!--酒店介绍信息修end改-->
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/froala_editor.min.js" type="text/javascript" charset="utf-8"></script>
<!--[if lt IE 9]>
<script src="../js/froala_editor_ie8.min.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->
<script src="js/tables.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/lists.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/colors.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/media_manager.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/font_family.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/font_size.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/block_styles.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/video.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/utf8-php/ueditor.config.js" type="text/javascript" charset="utf-8"></script>
<script src="js/utf8-php/ueditor.all.js" type="text/javascript" charset="utf-8"></script>
<!-- 加载编辑器的容器 -->
<script type="text/javascript">
var ue = UE.getEditor('container',{
		autoHeight: true,
		initialFrameHeight :310
	}
);
$(function(){
	ue.ready(function() {
		$('#btn_submit').click(function(){
				$('#content').val(ue.getContent());
			})
		
	});
})
</script>
</body>
</html>

