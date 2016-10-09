<?php
//连接数据库
function getConnection($host='localhost',$user='root',$password='',$dbname='project'){
	try{
		$pdo = new PDO("mysql:host=$host;dbname=$dbname;","$user","$password");
	}catch(PDOException $e){
		die("数据库连接失败".$e->getMessage());
	}
	$pdo->query("SET NAMES utf8");
	return $pdo;
}



//查询总记录
function total($table,$pdo){
	$sql="select * from $table";
	$stmt=$pdo->prepare($sql);
	$rows=$stmt->execute();
	return  $stmt->rowCount();
}



//增加
function insert($sql,$pdo){
	$rw = $pdo->exec($sql);
	return $rw;
}


//删除
function delete($sql,$pdo){
	$pdo->exec($sql);
}

//查找
function select($sql,$pdo){
	$st=$pdo->query($sql);
	
	$rs=$st->fetchAll();
	return $rs;
	//判断结果集为空 empty();
}


//修改
function update($sql,$pdo){
$rw = $pdo->exec($sql);
return $rw;
}


?>