<?php
//数据库链接文件
$host='localhost';//数据库服务器
$user='root';//数据库用户名
$password='123456';//数据库密码
$database='phpjiudian';//数据库名'
$conn=@mysql_connect($host,$user,$password) or die('数据库连接失败！');//连接数据库
@mysql_select_db($database) or die('没有找到数据库！');//选择数据库
mysql_query("set names 'gb2312'");//设置编码格式
function getoption($ntable,$nzd)
{
		$sql="select ".$nzd." from ".$ntable." order by id desc";
		$query=mysql_query($sql);//执行sql
		$rowscount=mysql_num_rows($query);//获得结果集的行的数目
		if($rowscount>0)//判断结果集的个数
		{
			for ($fi=0;$fi<$rowscount;$fi++)//循环结果集
			{
				?>
				<option value="<?php echo mysql_result($query,$fi,0);?>"><?php echo mysql_result($query,$fi,0);?></option>
				<?php
			}
		}
}
function getoption2($ntable,$nzd)
{
	?>
	<option value="">请选择</option>
	<?php
		$sql="select ".$nzd." from ".$ntable." order by id desc";
		$query=mysql_query($sql);
		$rowscount=mysql_num_rows($query);
		if($rowscount>0)
		{
			for ($fi=0;$fi<$rowscount;$fi++)
			{
				?>
				<option value="<?php echo mysql_result($query,$fi,0);?>" <?php 
				
				if($_GET[$nzd]==mysql_result($query,$fi,0))//如果get的参数等于搜索的结果输出selected
				{
					echo "selected";
				}
				?>><?php echo mysql_result($query,$fi,0);?></option>
				<?php
			}
		}
}
function getitem($ntable,$nzd,$tjzd,$ntj)
{
	if($_GET[$tjzd]!="")
	{
		$sql="select ".$nzd." from ".$ntable." where ".$tjzd."='".$ntj."'";
		$query=mysql_query($sql);
		$rowscount=mysql_num_rows($query);
		if($rowscount>0)
		{
			
				echo "value='".mysql_result($query,0,0)."'";
			
		}
	}
}
?>