<?php
session_start();
require("cart.php");
require("db.func.php");
$name=$_POST['name'];
switch ($name) {
	case 'cancle':
			$_SESSION['cart'] = array();
			$_SESSION['totalprice']=0;
			echo "1";
		break;

	case 'sure':
			$desk_num=$_POST['zhuohao'];
			$pdo=getConnection();
			$request="select count(*) desk from user where desk_num=$desk_num";
			$num=select($request,$pdo);
			if($num[0][0]!=0)
			{
				$date= date('y-m-d h:i:s',time());
			$sum=$_SESSION['totalprice'];
			$list=$_SESSION['list'];
				$sql="insert into user (c_time,cai_list,desk_num,c_sum)  values('".$date."','".$list."','".$desk_num."',$sum)";
				insert($sql,$pdo);
				echo "2";
			}
				
		else{
			$date= date('y-m-d h:i:s',time());
			$sum=$_SESSION['totalprice'];
			$list=$_SESSION['list'];
			$sql="insert into user (c_time,cai_list,desk_num,c_sum)  values('".$date."','".$list."','".$desk_num."',$sum)";
			insert($sql,$pdo);
			echo "1";
			}
		break;

	case 'refresh' :
			$zhuohao=$_POST['zhuohao'];
			$sql="select finish from user where desk_num=$zhuohao";
			$pdo=getConnection();
			$rs=select($sql,$pdo);
				if(empty($rs)){
					echo 2;
				$_SESSION['state']=2;
				$rs[0]['finish']=2;
				}
			else
				{
					$_SESSION['state']=$rs[0]['finish'];
				}
				echo $rs[0]['finish'];

			//付款的话，将用户从user表复制到copyuser表保存
			
				
		break;
		
	case 'continue' :
		$_SESSION['cart'] = array();
			$_SESSION['totalprice']=0;
			echo 2;
		break;

	case 'pay':
		 	$zhuohao=$_POST['zhuohao'];
		 	$sql="select finish from user where desk_num=$zhuohao";
		 	$pdo=getConnection();
			$rs=select($sql,$pdo);
			if(empty($rs)){
				echo 2;
			}
			else
			{
				echo $rs[0]['finish'];
			}
		break;


//厨师做好
	case 'finish':
		$zhuohao=$_POST['zhuohao'];
		$sql="update user set finish=1 where desk_num=$zhuohao";
		$pdo=getConnection();
		$rw=update($sql,$pdo);
		echo $rw;
		break;
//收银确认收款
	case 'paied':
			$zhuohao=$_POST['zhuohao'];
			$sql="update user set finish=2 where desk_num=$zhuohao";
			$pdo=getConnection();
			$rw=update($sql,$pdo);
				$sqls="select finish from user where desk_num=$zhuohao";
				$rs=select($sqls,$pdo);
				if($rs[0]['finish']==2){
					$sql1="insert into copyuser select * from user where desk_num=$zhuohao";
					update($sql1,$pdo);
					$sql2="delete from user where desk_num=$zhuohao";
					delete($sql2,$pdo);
			}
			echo 2;
		break;
	case "session":
		$i=$_POST['id'];
		$num=$_POST['a'];
		$kind=$_POST['kind'];
		if($kind=='del')
		{
			$_SESSION['cart'][$i]['num']=0;
			echo 0;
		}
		else 
		{
			$_SESSION['cart'][$i]['num']=$num;
			echo $num;
		}
		break;
	default:
		
		break;
}

?>