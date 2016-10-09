<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--禁止缩放start-->
<meta content="yes" name="apple-mobile-web-app-capable">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<!--禁止缩放end-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<!--引用-->
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<!--引用结束-->
<title>下单页面</title>

<style type="text/css">
	body{
		padding:0;
		margin:0;
	}
</style>

</head>

<?php
session_start();
require('../back/cart.php');
$cart=new Cart;
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$num=$_POST['num'];
$img=$_POST['img'];
$total=0.0;
for($i=1;$i<=count($num);$i++)
{
    $cart->addItem($id[$i-1],$name[$i-1],$price[$i-1],$num[$i-1],$img[$i-1]);
    
}

if($cart->getPrice()<=0) 
    echo ("<center><a href='../front/main.php'><img  src='images/dian.png' style='width:200px;height:200px;margin-top:55%' ></a></br></br><h4>您还未点餐</h4></center>");
else
{
    ?>
<body  bgcolor="FAF7EE" >
<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
	<br>
	<span style="color:white;font-size:20px;"><b>我的菜单</b></span>
</div>
<br/><br/><br/><br/>
<!--上半区域-->


<a href="../back/changeorder.php"><img style="width:40px;height:40px;margin-left:80%" src="images/shopping.png" ></a>
<br/>
<br/>
<div style="width:90%;height:100px; margin-left:5%; border-radius:10px;border-collapse:collapse; border:gray solid 1px; background-color:#FFF">
<table  cellspacing="0" cellpadding="0" width="100%" height="100%" border="0px">
	<tr >
        <td style="border-bottom:gray solid 1px; ">
                &nbsp;&nbsp;&nbsp;我在<input type="text" id="selectid" name="username" <?php if(!$_SESSION['desk_num']=="") echo "disabled readonly";?> size="3" 
                style="outline:medium; border-radius:5px; text-align:center;"   value="<?php echo $_SESSION['desk_num'];?>" >桌
		</td>
                
    </tr>
   	<tr>
    	<td>&nbsp;&nbsp;&nbsp;共：<?php  echo $cart->getNum(); $_SESSION["totalnum"]=$cart->getNum(); ?>道菜&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            共计：<!--显示组件--><?php echo $cart->getPrice();   $_SESSION['totalprice']= $cart->getPrice();?>元</td>
    </tr>  
</table>
</div>
<!--下半区域-->
<br/><br/><br/>
<div style="width:90%; margin-left:5%; border-radius:10px;border-collapse:collapse; border:gray solid 1px; background-color:#FFF">
<table  cellspacing="0" cellpadding="0" width="100%" height="100%" border="0px" style="text-align:center">
<?php
//记录所点菜
 $_SESSION['list']="";
 //记录一共的种类
 $_SESSION['totalkind']=count($num);
 //输出所点菜信息
    for($i=1;$i<=count($num);$i++)
    {    
        if($_SESSION['cart'][$i]['num']>0)
            {
                echo 
                "<tr>
                    <td style='height:50px;width:25%;border-bottom:solid gray 1px'>
                            &nbsp;&nbsp;".$_SESSION['cart'][$i]['name']."
                    </td>
                    <td style='height:50px;width:25%;border-bottom:solid gray 1px'>
                            ".$_SESSION['cart'][$i]['price']."元/份
                    </td>
                    <td style='height:50px;width:25%;border-bottom:solid gray 1px'>
                            ".$_SESSION['cart'][$i]['num']."份</span>
                    </td>
                    <td style='height:50px;width:25%;border-bottom:solid gray 1px'>
                            ".$_SESSION['cart'][$i]['num']*$_SESSION['cart'][$i]['price']."元       
                    </td>
                </tr>";
			  $_SESSION['list'].='_'.$_SESSION['cart'][$i]['name'].'_'.$_SESSION['cart'][$i]['num'].'_'.$_SESSION['cart'][$i]['price'];
            }
    }
   ?>
</table>

</div>

<br/><br/>

<div style="width:94%; margin-left:3%;">
	<!--开始下单-->
	<a href="#"  id="cancle" class="btn btn-danger btn-lg" style="margin-right:1%;font-size:17px;" >取消订单</a>
	<a href="#" id="sure" class="btn btn-success btn-lg   col-xs-offset-1" style="margin-left:1%;margin-right:1%;font-size:17px;">确认下单</a>
	<a href="main.php" class="btn btn-info btn-lg   " style="text-align:center;margin-left:1%;font-size:17px;">继续点餐</a>
<br/>

<!--下单成功模态框-->   
	<div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					菜品已成功下单 请稍等
					</div>
					<div class="modal-footer" style="text-align:center">
					<button type="button" class="btn btn-default"  data-dismiss="modal" onclick="wait()">确定</button>
					</div>
			  </div>
			</div>
		</div>

<!--取消订单模态框---->
		<div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					订单已取消
					</div>
					<div class="modal-footer" style="text-align:center">
					<button class="btn btn-default"  data-dismiss="modal" id="surer" onclick="tiao()" >确定</button>
					</div>
			  </div>
			</div>
		</div>

		
		
<!--zhuohao ---->
		<div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="desk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					请填写桌号
					</div>
					<div class="modal-footer" style="text-align:center">
					<button class="btn btn-default"  data-dismiss="modal" id="surer"  >确定</button>
					</div>
			  </div>
			</div>
		</div>
		
		
		<!--zhuohao ---->
		<div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="people" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					该桌子已有人
					</div>
					<div class="modal-footer" style="text-align:center">
					<button class="btn btn-default"  data-dismiss="modal" id="surer"  >确定</button>
					</div>
			  </div>
			</div>
		</div>
		
		
	</div>
<br/>

</body>

<?php }?>

<!--取消订单 ajax异步-->
<script type="text/javascript">
    $("#cancle").click(function(){
        $.post('../back/edit.php',{'name':'cancle'},function(data){
            if(data=='1')
				$('#myModal1').modal('show');
        
        });

    });

	$("#sure").click(function(){
        var zhuohao=$("#selectid").val();
        if(zhuohao=="") $('#desk').modal('show');
        else
        {
            $.post('../back/edit.php',{'name':'sure','zhuohao':zhuohao},function(data){
              if(data=='1'){
                 $('#myModal').modal('show');//显示模态框
                 
              }
                else{
					  $('#myModal').modal('show');//显示模态框
				    
                }   
            });
        }

    });

    //取消订单
    function tiao(){
          location.href = "main.php"; 
    }
    //订单完成
      function wait(){

            var zhuohao=$("#selectid").val();
           
          location.href = "state.php?zhuohao="+zhuohao; 
    }

</script>
</html>