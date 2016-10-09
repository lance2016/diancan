<?php
require_once("../db.func.php");
$pdo=getConnection();
$id=$_GET['id'];
$password=$_GET['password'];
$sql="select * from admin where level=1 and id='".$id."'";
$rw=select($sql,$pdo);
if(empty($rw)){
	echo "load fail";
}
else{
		$pwd= $rw[0]['password'];
		if(password_verify($password,$pwd))
			echo "manager/pay.php";
		else{
			echo "load fail";
		}
}
?>