<? 
function getname($exname){ 
   $dir = "uploadfile/"; 
   $i=1; 
   if(!is_dir($dir)){ 
      mkdir($dir,0777); 
   } 
   while(true){ 
     if(!is_file($dir.$i.".".$exname)){ 
        $name=$i.".".$exname; 
        break; 
      } 
     $i++; 
   } 
   return $dir.$name; 
} 
$exname=strtolower(substr($_FILES['upfile']['name'],(strrpos($_FILES['upfile']['name'],'.')+1))); //$_FILES['upfile']['name']从第(strrpos($_FILES['upfile']['name'],'.')+1)+1个位置开始截取到最后，返回的是一段字符串字
$uploadfile = getname($exname);  
if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) { 
	echo $uploadfile;
}
?>