<?php
include "conn.php";//连接数据库文件格式要设置成utf-8无bom格式，不知道什么鬼
//2.通过action的值做地应操作
$pdo->query("SET NAMES utf8");
		$shunxu=$_POST['shunxu'];
		$src = $_POST['src'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$press = $_POST['press'];
		$date = $_POST['date'];
		$intro = $_POST['intro'];
		$content= $_POST['content'];
		$catalog= $_POST['catalog'];
		$id = $_POST['id'];
 $sql = "update img set title='".$title."',author='".$author."',press='".$press."',date='".$date."' ,intro='".$intro."' ,content='".$content."',catalog='".$catalog."',shunxu='".$shunxu."' where title='".$id."'"; 
		 $rw = $pdo->exec($sql);
		 if($rw>0){
				 echo ('更新成功');
		 }else{
			 echo ('更新失败');
		 } 
	$pdo=null;



