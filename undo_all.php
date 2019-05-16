<?php
include_once 'conn.php';
//获取请求的数据
$table=$_POST['table'];
$ids=$_POST['ids'];
if(!$ids){
	$code=0;
	header('Content-Type:application/json');//加上这行,前端那边就不需要var result = $.parseJSON(data);
	$json = array("code" => $code);
	echo json_encode($json);//返回前端状态，成功删除！
	return false;
}
$n=0;//成功删除数
$m=0;//失败删除数
foreach($ids as $v)
{
    $sql = "update $table set `undo`='是' where id='{$v}' and `issh`='是'";
	mysql_query($sql);
	if(mysql_affected_rows() == 1){//执行成功则将n加1
		$n=$n+1;
	}else{
		$m=$m+1;
	}
}
$code=1;
header('Content-Type:application/json');//加上这行,前端那边就不需要var result = $.parseJSON(data);*/
$json = array("code" => $code,"n" => $n,"m" => $m);
echo json_encode($json);//返回前端状态，成功删除！
?>
