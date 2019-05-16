<?php 
session_start();
include_once 'conn.php';
date_default_timezone_set('PRC'); 
$ndate =date("Y-m-d");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html class="welcome_bg">
<head>
<title>welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="css/font-awesome.min.css.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/echartsHome.css" />
<link rel="stylesheet" href="css/codemirror.css" />
<link rel="stylesheet" href="css/carousel.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body class="welcome_bg">
<?php 
if($_SESSION['cx']=="注册用户")
	{
		?>
		<div class="welcome">欢迎进入管理界面</div>
        <?php
	}else{
		?>
        <div class="admin_top">
        	<div class="clearfix admin_con_top admin_con_top_spe">
                <h2 class="fl" style="letter-spacing:2px;">系统信息统计</h2>
                <p class="fr" style="height:40px;line-height:40px;">当前日期： <?php echo $ndate; ?></p>
            </div>
            <ul class="date_show_ul clearfix">
                <li>
					<?php 
						$sql="select * from yonghuzhuce where issh='是'";//统计审核的用户数据
						$query=mysql_query($sql);
						$rowscount=mysql_num_rows($query);
						date_default_timezone_set('PRC');
						$start = date('Y-m-01 00:00:00');//统计本月的审核用户数据
						$end = date('Y-m-d H:i:s');
						$sql="select * from yonghuzhuce where issh='是' and unix_timestamp(addtime) >= unix_timestamp('".$start."') and unix_timestamp(addtime) <= unix_timestamp('".$end."')";
						$query=mysql_query($sql);
						$mothscount=mysql_num_rows($query);
					?>
                    <h4 class="data_1">用户数量</h4>
                    <div class="clearfix">
                    	<div class="fl">
                        	<h4><?php echo $rowscount;?></h4>
                            <p>总数</p>
                        </div>
                        <div class="fl">
                        	<h4><?php echo $mothscount;?></h4>
                            <p>新增</p>
                        </div>
                    </div>
                </li>
                <li>
                	<?php 
						$sql="select sum(`number`) as `total` from jiudianxinxi where 1=1";//统计每个客房的数量总和
						$query=mysql_query($sql);
						$result = mysql_fetch_array($query);
						$rowscount = $result['total'];
						date_default_timezone_set('PRC');
						$start = date('Y-m-01 00:00:00');//统计本月每个客房的数量总和
						$end = date('Y-m-d H:i:s');
						$sql="select sum(`number`) as `total` from jiudianxinxi where 1=1 and unix_timestamp(addtime) >= unix_timestamp('".$start."') and unix_timestamp(addtime) <= unix_timestamp('".$end."')";
						$query=mysql_query($sql);
						$result = mysql_fetch_array($query);
						$mothscount = $result['total'];
					?>
                    <h4 class="data_2">客房数量</h4>
                    <div class="clearfix">
                    	<div class="fl">
                        	<h4><?php echo $rowscount;?></h4>
                            <p>总数</p>
                        </div>
                        <div class="fl">
                        	<h4><?php echo $mothscount;?></h4>
                            <p>新增</p>
                        </div>
                    </div>
                </li>
                <li>
                
                <?php 
						$sql="select * from jiudianyuding where 1=1";//统计客房总订单量
						$query=mysql_query($sql);
						$rowscount=mysql_num_rows($query);
						date_default_timezone_set('PRC');
						$start = date('Y-m-01 00:00:00');//统计本月客房总订单量
						$end = date('Y-m-d H:i:s');
						$sql="select * from jiudianyuding where 1=1 and unix_timestamp(addtime) >= unix_timestamp('".$start."') and unix_timestamp(addtime) <= unix_timestamp('".$end."')";
						$query=mysql_query($sql);
						$mothscount=mysql_num_rows($query);
					?>
                    <h4 class="data_3">订单统计</h4>
                    <div class="clearfix">
                    	<div class="fl">
                        	<h4><?php echo $rowscount;?></h4>
                            <p>总数</p>
                        </div>
                        <div class="fl">
                        	<h4><?php echo $mothscount;?></h4>
                            <p>新增</p>
                        </div>
                    </div>
                </li>
                <li>
                    <?php 
						$sql="select * from yuangongxinxi where 1=1";//统计员工总数
						$query=mysql_query($sql);
						$rowscount=mysql_num_rows($query);
						date_default_timezone_set('PRC');
						$start = date('Y-m-01 00:00:00');//统计本月添加员工数
						$end = date('Y-m-d H:i:s');
						$sql="select * from yuangongxinxi where 1=1 and unix_timestamp(addtime) >= unix_timestamp('".$start."') and unix_timestamp(addtime) <= unix_timestamp('".$end."')";
						$query=mysql_query($sql);
						$mothscount=mysql_num_rows($query);
				   ?>
                   <h4 class="data_4">酒店员工</h4>
                   <div class="clearfix">
                    	<div class="fl">
                        	<h4><?php echo $rowscount;?></h4>
                            <p>总数</p>
                        </div>
                        <div class="fl">
                        	<h4><?php echo $mothscount;?></h4>
                            <p>新增</p>
                        </div>
                    </div>
                </li>
            </ul>
            <!--数据可视化-->
            <div class="bar_show">
                <div id="graphic">
                    <div id="main" class="main"></div>
                </div>
            </div>
            <!--数据可视化end-->
		</div>
    <?php
	}
?>
		<!--获取近七天入住营业额-->
		<?php
		   $sql = "select * from ruzhuxinxi where date_sub(curdate(), interval 7 day) <= date(addtime)";
		   $result = mysql_query($sql);
		   $day_time = 24*60*60;
		   $day = array();
		   date_default_timezone_set('PRC');
		   for($i = 0; $i < 7; $i++){
		 		$day[$i]['timestamp'] = strtotime(date('Y-m-d')) - $i * $day_time;
				$day[$i]['format'] = date('m/d',$day[$i]['timestamp']);
				$day[$i]['total_price'] = 0;
		   }
		   while($row = mysql_fetch_assoc($result)) {
			   foreach($day as $k => $v){
				   		if(strtotime(date('Y-m-d',strtotime($row['addtime']))) == $v['timestamp']){
								$day[$k]['total_price'] += $row['price'];
							}
				   }
				}
		?>
        <!--获取近七天预订营业额-->
		<?php
		   $sql = "select * from jiudianyuding where date_sub(curdate(), interval 7 day) <= date(time)";
		   $result = mysql_query($sql);
		   $day_time = 24*60*60;
		   $book = array();
		   date_default_timezone_set('PRC');
		   for($i = 0; $i < 7; $i++){
		 		$book[$i]['timestamp'] = strtotime(date('Y-m-d')) - $i * $day_time;//获取近七天每一天的时间戳
				$book[$i]['format'] = date('m/d',$book[$i]['timestamp']);
				$book[$i]['total_price'] = 0;
		   }
		   while($row = mysql_fetch_assoc($result)) {
			   foreach($book as $k => $v){
				   		if(strtotime(date('Y-m-d',strtotime($row['time']))) == $v['timestamp']){
								$book[$k]['total_price'] += $row['price'];
							}
				   }
				}
		?>
        <!--获取近七天成交营业额-->
		<?php
		   $sql = "select * from jiudianyuding where issh='是' and `leave`='是' and date_sub(curdate(), interval 7 day) <= date(time)";
		   $result = mysql_query($sql);
		   $day_time = 24*60*60;
		   $deal = array();
		   date_default_timezone_set('PRC');
		   for($i = 0; $i < 7; $i++){
		 		$deal[$i]['timestamp'] = strtotime(date('Y-m-d')) - $i * $day_time;
				$deal[$i]['format'] = date('m/d',$deal[$i]['timestamp']);
				$deal[$i]['total_price'] = 0;
		   }
		   while($row = mysql_fetch_assoc($result)) {
			   foreach($deal as $k => $v){
				   		if(strtotime(date('Y-m-d',strtotime($row['time']))) == $v['timestamp']){
								$deal[$k]['total_price'] += $row['price'];
							}
				   }
				}
		?>
</body>
<script src="js/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/dist/echarts.js" type="text/javascript" charset="utf-8"></script>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

		
        // 路径配置
        require.config({
            paths: {
                echarts: 'js/dist/'
            }
        });
        
        // 使用
        require(
            [
                'echarts',
				'echarts/chart/bar',
                'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
						
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('main')); 
                
              var option = {
				title : {
					text: '近期客房使用情况',
					subtext: '营业额'
				},
				tooltip : {
					trigger: 'axis'
				},
				legend: {
					data:['入住','预订','成交']
				},
				toolbox: {
					show : true,
					feature : {
						dataView : {show: true, readOnly: false},
						magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
						restore : {show: true},
						saveAsImage : {show: true}
					}
				},
				calculable : true,
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : [//日期
						"<?php echo $day[6]['format']?>",
						'<?php echo $day[5]['format']?>',
						'<?php echo $day[4]['format']?>',
						'<?php echo $day[3]['format']?>',
						'<?php echo $day[2]['format']?>',
						'<?php echo $day[1]['format']?>',
						'<?php echo $day[0]['format']?>'
						]
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : [
					{
						name:'入住',
						type:'line',
						smooth:true,
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:[
						"<?php echo $day[6]['total_price']?>", 
						"<?php echo $day[5]['total_price']?>",
						"<?php echo $day[4]['total_price']?>", 
						"<?php echo $day[3]['total_price']?>",
						"<?php echo $day[2]['total_price']?>",
						"<?php echo $day[1]['total_price']?>",
						"<?php echo $day[0]['total_price']?>",
						]
					},
					{
						name:'预订',
						type:'line',
						smooth:true,
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:[
						"<?php echo $book[6]['total_price']?>",
						"<?php echo $book[5]['total_price']?>",
						"<?php echo $book[4]['total_price']?>",
						"<?php echo $book[3]['total_price']?>",
						"<?php echo $book[2]['total_price']?>",
						"<?php echo $book[1]['total_price']?>",
						"<?php echo $book[0]['total_price']?>"
						]
					},
					{
						name:'成交',
						type:'line',
						smooth:true,
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:[
						"<?php echo $deal[6]['total_price']?>",
						"<?php echo $deal[5]['total_price']?>", 
						"<?php echo $deal[4]['total_price']?>",
						"<?php echo $deal[3]['total_price']?>",
						"<?php echo $deal[2]['total_price']?>",
						"<?php echo $deal[1]['total_price']?>",
						"<?php echo $deal[0]['total_price']?>",
						]
					}
				]
			};
                // 为echarts对象加载数据 
                myChart.setOption(option); 
            }
        );
    </script>
</html>
