<?php 
session_start();
?>
<div class="header content" id="_01">
	<div class="head_top clearfix">
		<p class="fl"><a href="index.php">酒店信息管理系统</a></p>
		<ul class="nav_ul clearfix fl">
			<li><a href="index.php">网站首页</a></li>
			<li><a href="user_news.php?lb=酒店优惠">酒店优惠</a></li>
			<li><a href="dx_detail.php?lb=酒店介绍">酒店介绍</a></li>
			<li><a href="user_foodlist.php">餐饮预订</a></li>
			<li><a href="user_roomlist.php">客房信息</a></li>
            <li class="<?php if($_SESSION['cx']!="" ){?>txt_none_i<?php }?>" id="reg_login">注册/登录</li>
			<li><a href="login.html">后台管理</a></li>
		</ul>
        <?php 
			if ($_SESSION['cx']!="" )
				{
		?>
        <div class="user_msg fl">
			<p>欢迎您！<?php echo $_SESSION['username']?></p>
            <p>
                <span onclick="javascript:location.href='logout.php';">退出</span>
                <span onclick="javascript:location.href='main.php';">个人后台</span>
            </p>
		</div>
        <?php 
			}
			else
			{
		 ?>
         <div class="user_msg fl">
			<p></p>
            <p></p>
		</div>
         <?php } ?>
	</div>
</div>