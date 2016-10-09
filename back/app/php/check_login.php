<?php 
require "../../db.func.php";
session_start();
if(isset($_SESSION['session_id']))
	{
		$sql="select session_id from admin where id='".$_SESSION['user']."'";
		$pdo=getConnection();
		$stmt = $pdo->query($sql);
		$row=$stmt->fetch();
		$session_id=$row['session_id'];
		
		if($session_id==$_SESSION['session_id'])
			;

		else  {
				unset($_SESSION['user']);
				unset($_SESSION['session_id']);
				header("Location:welcome.php");
				exit();
			}
	}
else
	{
		
		header("Location:welcome.php");
		exit();
	}
		$pdo=null;
?>