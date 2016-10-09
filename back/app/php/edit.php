<?php
require_once "../../db.func.php";
//include "conn.php";//连接数据库文件格式要设置成utf-8无bom格式，不知道什么鬼
//2.通过action的值做地应操作
$pdo=getConnection();
switch($_GET['action']){
//登录验证 
	 case "login":
		$username=$_GET['user'];
		$password=$_GET['password'];
		$sql="select * from admin where id='".$username."'";
		$stmt=select($sql,$pdo);
				$pwd=$stmt[0]['password'];
		if(!empty($stmt) &&password_verify($password,$pwd)&&$stmt[0]['level']==1){
			session_start();
			$_SESSION['user']=$username;
			$_SESSION['nickname']=$stmt[0]['nickname'];
			date_default_timezone_set("Asia/Shanghai");
			$nowtime=gmdate('H:i:s:ms',time()); 
			$_SESSION['session_id']=$username.$nowtime;
			/* 多账号同时登录 */
			$sql1="update  admin set session_id='".$username.$nowtime."' where id='".$username."'";
			$rw = $pdo->exec($sql1);
			
			echo '登陆成功';
		}
		else 
			echo "用户名或密码错误".$stmt;
			$pdo=null;
	 break;
	 
	 
	 case "register" :
			$user=$_GET['user'];
			$p1=$_GET['password1'];
			$p2=$_GET['password2'];
			$sql1="select * from admin where id='".$user."'";
			$p=select($sql1,$pdo);
			if(empty($p)){
				if($p1==$p2){
					
					$password=password_hash($p1, PASSWORD_DEFAULT);
					$sql2="insert into admin values('".$user."','".$password."',0,'0','暂无昵称')";
					$rw=insert($sql2,$pdo);
					if($rw)
						echo "注册成功";
					else
						echo "注册失败";
				}
				else 
					echo "两次密码不一致";
			}
			else 
				echo "该账户已被注册";
			
			break;
	 
	 case "zhuxiao":
	 	session_start();
	 	unset($_SESSION['user']);
		echo '<script>location.href="../#/index/main/welcome"</script>';
			$pdo=null;
	 break;
	 


	 case "change_password":
		
			$id=$_GET['id'];
			$p1=$_GET['psw1'];
			$p2=$_GET['psw2'];
			if($p1==$p2){
				$password=password_hash($p1, PASSWORD_DEFAULT);
				$sql2="update admin set password='".$password."' where id='".$id."'";
					$rw=update($sql2,$pdo);
					if($rw)
						echo "修改成功";
					else
						echo "修改失败";
				}
				else 
					echo "两次密码不一致";
			
			break;
			
			

	 case "change_id":
		$id=$_GET['id'];
		$name=$_GET['name'];
		$sql2="update admin set nickname='".$name."' where id='".$id."'";
			$rw=update($sql2,$pdo);
					if($rw)
						echo "成功";
					else
						echo "失败";
			session_start();		
		$_SESSION['nickname']=$name;
				
		break;
		
	case "profit":
		echo "10";
	 break;
	  
	 
	case "del": //删除操作
		$db=$_GET['db'];
		$title = $_GET['title'];
		$src = $_GET['src'];
		if($db=='caidan')
			$sql = "delete from caidan where img='".$src."'";
		else
			$sql="delete from fenlei where Id=".$title;
		$pdo->exec($sql);
		 unlink('../'.$src);
		 // echo '<script>location.href="../#/index/main/welcome"</script>';
		// echo $sql;
		 	$pdo=null;
	break;
	
	
	
	case "show"://展示菜单
	$db=$_GET['db'];
		$pageNo=$_GET['pageNo'];
		$pageSize=$_GET['pageSize'];
		if($db=='caidan')
			$sql = "select * from caidan order by c_type desc limit ".$pageNo.",".$pageSize;		
		else 
			$sql="select * from ".$db." order by shunxu desc limit ".$pageNo.",".$pageSize;
		$data=$pdo->query($sql)->fetchAll();
		$paodata = json_encode($data);
		 echo $paodata;
		 	$pdo=null;
		
	break;
	
	
	
	case "showTotal"://计数
		$db=$_GET['db'];
		$sql = "select count(*) num from ".$db;
		$q = $pdo->query($sql);
		$rows = $q->fetch();
		$rowCount = $rows[0];
				echo	$rowCount; 
					$pdo=null;

	break;
	
	
	
	
	case "search"://搜索
		$select = $_GET['select'];
		$keywords = $_GET['keywords'];
		if($select=='all')
			$sql = "select * from caidan where c_name like '%".$keywords."%'";
		else
			$sql="select * from caidan where c_name like '%".$keywords."%' and c_type=".$select;
		  $stmt = $pdo->query($sql);
			if(!empty($stmt) AND $stmt->rowCount() > 0){
				 $datas=$pdo->query($sql)->fetchAll();
				$paodata = json_encode($datas);
				echo $paodata; 
			 }
			 else{
				echo ("失败");
			}    
				$pdo=null;
	break;
	
	
//编辑书籍	
	case "editbook":
		$db=$_GET['db'];
		 $title = $_GET['title'];
		 if($db=='caidan')
			$sql = "select * from caidan where c_name='".$title."'";
		 else
			 $sql="select * from fenlei where Id=".$title;
		 $data=$pdo->query($sql)->fetchAll();
		  $paodata = json_encode($data);
		  echo $paodata;		
			$pdo=null;
	break;
	
	case "update":
		$db=$_GET['db'];
		if($db=='caidan'){
			$c_id=$_GET['c_id'];
			$c_name = $_GET['c_name'];
			$c_price = $_GET['c_price'];
			$c_jieshao = $_GET['c_jieshao'];
			$c_type = $_GET['c_type'];		
			$sql = "update caidan set c_name='".$c_name."',c_price='".$c_price."',c_jieshao='".$c_jieshao."',c_type='".$c_type."'  where c_id='".$c_id."'"; 
		}
		else{
			$id=$_GET['id'];
			$name=$_GET['name'];
			$shunxu=$_GET['shunxu'];
			$sql="update fenlei set name='".$name."',shunxu=".$shunxu." where Id=".$id;
		}
		
		 $rw = $pdo->exec($sql);
		 if($rw>0){
				 echo ('更新成功');
		 }else{
			 echo ('更新失败');
		 } 
	$pdo=null;
	break;
	case "add_class":
		$name=$_GET['name'];
		$shunxu=$_GET['sort'];
		
		$sql="select * from fenlei where name='".$name."'";
		$stmt=select($sql,$pdo);
		if(!empty($stmt)) 
			echo "已有该类型";
		else{
			$sql1="select max(type)+1 max from fenlei;";
			$result=select($sql1,$pdo);
		$sql2="insert into fenlei (name,shunxu,type) values ('".$name."',".$shunxu.",".$result[0]['max'].")";
		$rw=insert($sql2,$pdo);
					if($rw)
						echo "添加成功";
					else
						echo "添加失败".$sql2;
		}
			
		
		
				
	break;
		



}

