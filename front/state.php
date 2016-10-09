<?php session_start(); 
require("../back/db.func.php");
$pdo=getConnection();
error_reporting(0);?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/bootstrap_i.css"/>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<title>当前状态</title>
		<style type="text/css">
			body{
				padding:0;
				margin:0;
				}
			.main
			{
				text-align:center;
				min-height:400px;
				width:88%; 
				margin-left:6%; 
				margin-top:-30px;
				 border:solid 1px #EAE7DE;
				 border-radius:15px;
				 background-color:#FFF;
				}
		</style>
		</head>
	<body  bgcolor="#FAF7EE">
		<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
			<br>
			<span style="color:white;font-size:20px;"><b>当前状态</b></span>
		</div>
		<br/><br/><br/><br/><br/>
        <hr style='text-align:center; height:15px; border:#A69E9C solid 1px; border-radius:15px;' color="#A69E9C" width='90%'>
        <div class="main">
        <table width="100%"> 
			<tr height="100px" style="font-size:30px; text-align:left">  <!--显示座位号-->	
            	<td style="padding-left:5px; width:33%">桌号：</td>
				<td id="zhuo"><?php echo  $zhuohao=$_GET['zhuohao'];?></td>
            </tr>
            <tr height="30px"  style="font-size:15px;">		 <!--显示表单信息-->
            	<td style="border-bottom:dotted 1px #000000">名称</td>
                <td style="border-bottom:dotted 1px #000000">份数</td>
                <td style="border-bottom:dotted 1px #000000">单价</td>
                <td style="border-bottom:dotted 1px #000000">金额</td>		<!--状态分为已完成，未完成，缺少食材？-->
            </tr>


<!--前两行固定格式，后面两行分别显示菜品信息（名称、数量、金额、状态）和时间+总金额------------------------------------>
          
<?php
     
	$sql="select * from user where desk_num=".$_GET['zhuohao'];
	$data=select($sql,$pdo);	 
	$sql2="select COUNT(*) num from user where desk_num=".$_GET['zhuohao'];
	$num=select($sql2,$pdo);
	$sql3="select sum(c_sum) money from user where desk_num=".$_GET['zhuohao'];
	$totalmoney=select($sql3,$pdo);
	if($totalmoney[0]['money']!="")
		$money=$totalmoney[0]['money'];
	for($i=0;$i<$num[0]['num'];$i++){ ?>
		
		 <?php
		  $arr=explode('_',$data[$i]['cai_list']);//获取菜单列表
          $total=substr_count($data[$i]['cai_list'],"_");//获取菜的数目
		  $k=$i+1;
			echo 
			"<tr>
			<th colspan='4' style='height:20px'>第". $k."次订单</th>
			</tr>";
		 for($j=1;$j<=$total;$j++){
            ?>
             <tr height="40px" style="font-size:18px;">  
                <td>  <?php  echo "$arr[$j]"; $j++;?></td>
				<td> <?php $fen=$arr[$j]; echo "$arr[$j]"; $j++;?>份</td>
                <td><?php $jia=$arr[$j];echo $arr[$j];?>元/份</td>
                <td><?php echo $fen*$jia; ?>元</td>
            </tr> 
		 <?php } ?>
		 
		
		 <?php
	}
	
            ?>  
             <tr height="40px">
					<table style="font-size:18px;">
                    	<tr>
                          	<td  style="padding-left:7px;">状态:</td>
                            <td>
							<?php if(!isset($_SESSION['state'])) 
									$_SESSION['state']==0;
									if($_SESSION['state']==0) echo "未完成";
									else if($_SESSION['state']==1) echo "已完成";
									else if($_SESSION['state']==2) {
										echo "已付款";
										$_SESSION['cart'] = array();
										$_SESSION['state']=0;
										session_unset();
										session_destroy();
									}
								?>
							</td>
                            <td width="10%"></td>
                         <?php if($money!="") echo "<td>总计:</td><td>".$money."元";?></td>
                        </tr>
                 </table>
            </tr>    			
        </table>
        </div>
        <br/>
        <br/>
<!--操作按钮---------->        
        <div style="width:90%; height:100px; margin-left:5%; text-align:center">
		  <?php if($_SESSION['state']!=2){?><a href="#"  id="refresh" class="btn btn-danger btn-lg" style="text-align:center; width:23%">刷新</a><?php }?>
		  <a href="#" id="pay" class="btn btn-success btn-lg" style="text-align:center;margin-left:2%; width:23%">付款</a> 
		 <?php if(!$money=="") {?> <a href="#" id="continue"  class="btn btn-success btn-lg" style="text-align:center;margin-left:2%; width:23%">点餐</a><?php }?> 
        </div>
        </br>			  
	</body>
	
	<!--模态框--->
 <div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="my" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					已清空购物车
					</div>
					<div class="modal-footer" style="text-align:center">
					<button type="button" class="btn btn-default"  data-dismiss="modal" onclick="history.go(0)">确定</button>
					</div>
			  </div>
	</div>
</div>
<script type="text/javascript">

	function generateMixed(n) {
				var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
				 var res = "";
				 for(var i = 0; i < n ; i ++) {
					 var id = Math.ceil(Math.random()*35);
					 res += chars[id];
				 }
				 return res;
			}
			
    $(document).ready(function(){
        // window.location.reload();
    });
		$("#refresh").click(function(){
			var a=$("#zhuo").text();
			 $.post('../back/edit.php',{'name':'refresh','zhuohao':a},function(data){
				 if(data==2){                   //已付款
					 window.location.reload();
					 $("#refresh").attr("disabled", true); 
					 // alert("a");
				 }
				 else 
					  window.location.reload();
             		
            });
		});
		
		
		$("#continue").click(function(){
			var a=$("#zhuo").text();
			 $.post('../back/edit.php',{'name':'continue','zhuohao':a},function(data){
				if (data==2)
					location.href="main.php";
            });
		});
		
$("#pay").click(function(){
            var a=$("#zhuo").text();
             $.post('../back/edit.php',{'name':'pay','zhuohao':a},function(data){
                if(data==2)
					$('#my').modal('show');
                 //   alert("谢谢惠顾，欢迎下次再来");
                else{
					
						  location.href="../pay/payment.php?a="+generateMixed(10);
		
				}
                
                  
            });
			
			
	
        });

       
</script>
</html>
