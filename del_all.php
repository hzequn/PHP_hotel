<?php
include_once 'conn.php';
//获取请求的数据
$table=$_POST['table'];
$ids=$_POST['ids'];
if(!$ids){
	$code=0;
	header('Content-Type:application/json');//加上这行,前端那边就不需要var result = $.parseJSON(data);
	$json = array("code" => $code);
	echo json_encode($json);//返回给前端！
	return false;
}
$n=0;//成功删除数
foreach($ids as $v)
{
    $sql = "delete from $table where id='{$v}'";
    mysql_query($sql);
	if(mysql_affected_rows() == 1){
		$n=$n+1;
	}
}
$code=1;
header('Content-Type:application/json');//加上这行,前端那边就不需要var result = $.parseJSON(data);*/
$json = array("code" => $code,"n" => $n);
echo json_encode($json);//返回给前端，成功删除！
?>