
<?php
header("Content-type: text/html; charset=utf-8"); 
require_once("../db.func.php");
$pdo=getConnection();
$id=$_GET['id'];
$password=$_GET['password'];

$sql="select * from admin where level=0 and id='".$id."'";
$rw=select($sql,$pdo);
if(empty($rw)){
	echo "load fail";
}
else{
		$pwd= $rw[0]['password'];
			if(password_verify($password,$pwd))
				echo "chef/kitchen.php";
	else{
		echo "load fail";
	}
}
?>