<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<!--<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/hammer.js/2.0.8/hammer.min.js"></script>
<link rel="stylesheet" href="../front/css/bootstrap.css" />
<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
	<br>
	<span style="color:white;font-size:20px;"><b>购物车</b></span>
</div>
<div style="height:60px"></div>
<?php
session_start();
require("cart.php");
require("db.func.php");
if($_SESSION['totalprice']<=0){
 	echo "<center><h3>购物车为空,<a href='../front/main.php'>继续点餐</a></h3></center>";
}
else {
echo "<table class='table' style='margin-top:0px'>";
for($i=1;$i<=$_SESSION['totalkind'];$i++)
    {    
        if($_SESSION['cart'][$i]['num']>0)
            {
                echo 
                "<tr>
                    <td style='height:50px;width:30%;text-align:center;'>
                            &nbsp;&nbsp;".$_SESSION['cart'][$i]['name']."
                    </td>
                    <td style='height:50px;width:35%;text-align:center;'>
                            ".$_SESSION['cart'][$i]['price']."元/份
                    </td>
                    
               
					<td>
						<form>	
							<input type='button' class='btn btn-danger btn-xs' value='-' style='width:25px;border-radius:25px;border:none;' id=".$i."_sub >
							<input type='text' readonly='readonly' id=num_".$i."_add value=".$_SESSION['cart'][$i]['num']." style='width:20px;text-align:center'  name='num[]'  > 
							<input type='button'  class='btn btn-success btn-xs' id=".$i."_add  value='+'  style='width:25px;border-radius:25px;border:none;text-align:center';>
	
							<input type='button'  class='btn btn-danger btn-xs' id=".$i."_del  value='×'  style='margin-left:4px;width:25px;border-radius:25px;border:none;text-align:center';>
						</form>
					</td>
                </tr>";
            }
    }
   ?>
   </table>
<div style="width:90%; margin-left:5%;text-align:center;">
<button id="clear" class="btn-danger btn btn-lg">清空购物车</button>
<button id="back" class='btn-success btn btn-lg'style="margin-left:5%;">返回点餐界面</button>
</div>
 <?php } ?>
 
 

 
 
 
 
 
 
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
<div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					已删除
					</div>
					<div class="modal-footer" style="text-align:center">
					<button type="button" class="btn btn-default"  data-dismiss="modal" onclick="history.go(0)">确定</button>
					</div>
			  </div>
	</div>
</div>

<script type="text/javascript">
    $("#back").click(function(){
     location.href="../front/main.php";
    });
	
	$("#clear").click(function(){
		 $.post('edit.php',{'name':'cancle'},function(data){
			if(data==1){
				//$_SESSION['totalprice']=0;
				$('#my').modal('show');
				//history.go(0);
			}
				
        });
	});
	
	
	
	

//增加减少订单逻辑判断
$(function(){
  $("input").click(function () {
   var method=$(this).attr("id");
	var id=method.split('_');	
			var a=$("#num_"+id[0]+"_add")[0].value;
	if(id[1]=='del')			
		$('#del').modal('show');
	else{
		//alert(a+1);
			if(method.indexOf('add')!=-1)
			{			
				if(a=="0"){
					$("#num_"+id[0]+"_add")[0].value = "1";
						a=1;
					//	$('#'+id[0]+'_sub').show();
				}
				else{
						//alert(a+1);
					a=Number(a)+1;
					$("#num_"+id[0]+"_add")[0].value=a;
				}
			}
				
			else 
				{
					//alert("sub");
					if(a=="1"||a=="0"||a==""){
						$("#num_"+id[0]+"_add")[0].value="0";	
							a=0;
						//$('#'+id[0]+'_sub').hide();
					}
					else{
						a=Number(a)-1;
						$("#num_"+id[0]+"_add")[0].value=a;
					}
					
				}
		
	}
			
	$.post('edit.php',{'name':'session','id':id[0],'kind':id[1],'a':a},function(data){
         ;
        });			
	
});




});

</script>