<?php 
require_once "db.func.php";
//include "conn.php";//连接数据库文件格式要设置成utf-8无bom格式，不知道什么鬼
//2.通过action的值做地应操作

		$pdo=getConnection();
		$sql="select * from admin where id='root'";
		$stmt=select($sql,$pdo);
		print_r($stmt);
		echo $stmt[0]['password']."<br/>";
		echo !empty($stmt);
	//	echo $stmt->rowCount();
		// $stmt = $pdo->query($sql);
		// 	$row=$stmt->fetch();
		// 		$pwd=$row['password'];
				?>