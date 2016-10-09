<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<!--<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/hammer.js/2.0.8/hammer.min.js"></script>
<title>菜单</title>
<link rel="stylesheet" href="css/bootstrap.css" />
<style type="text/css">
	body{
		padding:0;
		margin:0;
		background-color:#FFFEF9;
	}
	.cai{
		border-bottom:solid 1px #ECE6E3;
	}
	tr{
		height:200px
	}
	td{
		height:100%
	}
	
    </style>
</head>
<body >
<form method="post" action="order.php" id="formId">
<div class="cai">
<table style="text-align:center;width:100%" class="table">
	
<?php
error_reporting(0);
//调取数据库内菜单内容，显示
require("../back/cart.php");
require("../back/db.func.php");
$pdo=getConnection();
$total=total('caidan',$pdo);
$sql="select * from caidan order by shunxu desc";
$rs=select($sql,$pdo);
$rs1=select('select count(*) nu from caidan group by c_type',$pdo);
$k=0;$l=0;
for($j=0;isset($rs1[$j]['nu']);$j++){
	$k+=$rs1[$j]['nu'];
 for ($i=$l;$i<$k; $i++){ 
 $img[$i]=split("_",$rs[$i]['img']);
$sql="select count(c_id) locate from caidan where c_id<=".$rs[$i]['c_id'];
 	$locate=select($sql,$pdo);
 	

 if($i==0||$rs[$i]['c_type']!=$rs[$i-1]['c_type'])
 {
	  $di='div';
 }
 else {
	$di=$rs[$i]['c_id'];
 }
//echo $locate[0]['locate'];

		echo
		"<tr style='width:100%;height:100%' id=".$di.$rs[$i]['c_type'].">
			<td style='width:30%;padding:10px'>
				<a  data-toggle='modal' data-target='#myModal' id=".$rs[$i]['c_jieshao']."_".$rs[$i]['img']."  onclick='check(this)' >
					<img src=../back/app/".$img[$i][0]. " style='height:80px;width:70px'>
				</a>
			</td>

			<input type='hidden' name='id[]' value=".$locate[0]['locate'].">  
			<input type='hidden' name='name[]' value=".$rs[$i]['c_name'].">
			<input type='hidden' name='price[]' value=".$rs[$i]['c_price'].">
			<input type='hidden' name='img[]' value=".$img[$i][0].">
			
			<td style='width:60%;text-align:left;padding:0px'>
				<h5>
				<a  data-toggle='modal' data-target='#myModal' id=".$rs[$i]['c_jieshao']."_".$rs[$i]['img']."  onclick='check(this)' >".$rs[$i]['c_name']."</a>
				</h5>
				<label style='color:red;font-size:16px'>
					价格：￥".$rs[$i]['c_price']."
				</label>
				<br><br>
			</td>
				<td style='width:10%;text-align:center;padding-right:20px;'>
			<div id='num' style='width:100%;min-width:80px;'>
			 <input type='button' class='btn btn-danger btn-xs' value='-' style='width:25px;border-radius:25px;border:none;' id=".$rs[$i]['c_id']."_sub >
			 <input type='text' readonly='readonly' id=num_".$rs[$i]['c_id']."_add value='0' style='width:20px;text-align:center'  name='num[]'  > 
			  <input type='button'  class='btn btn-success btn-xs' id=".$rs[$i]['c_id']."_add  value='+'  style='width:25px;border-radius:25px;border:none;text-align:center';>
			  </div>
			  </td>
			</td>
		</tr>
		";	
	}
	$l+=$rs1[$j]['nu'];//记录加载完的记录条数
	echo "</p>";
}
	?>
	</table>
</div>
<div style="position:fixed;bottom:0;width:100%;background-color:blue;">
	<input type="submit" value="点菜" >
	<!--<img src="images/queding.jpg" style="height:0px;position:absolute;bottom:0;right:150px" />-->
</div>

</form>


<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal"  tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
               aria-hidden="true">×
            </button>
            <h4 class="modal-title" id="myModalLabel">
               简介 
            </h4>
         </div>
         <div class="modal-body">
         <!--轮播开始-->
			<div id="myCarousel" class="carousel slide">
			   <!-- 轮播（Carousel）指标 -->
			   <!--<ol class="carousel-indicators">
				  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				  <li data-target="#myCarousel" data-slide-to="1" ></li>
				  <li data-target="#myCarousel" data-slide-to="2" ></li>
			   </ol>   -->
			   <!-- 轮播（Carousel）项目 -->
			   <div class="carousel-inner">
				  <div class="item active" >
					 <img src="images/cai1.jpg" id="img1" style="width:100%;height:200px" alt="First slide">
					 <div class="carousel-caption"></div>
				  </div>
				  
			   </div>
			 
			</div> 
				<div id="intro"><center><h4 id="jieshao">ds</h4></center></div>
<!--轮播结束-->
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">
               关闭
            </button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
//左右滑动
    $(function(){
            var myElement= document.getElementById('myCarousel')
            var hm=new Hammer(myElement);
            hm.on("swipeleft",function(){
                $('#myCarousel').carousel('next')
            })
            hm.on("swiperight",function(){
                $('#myCarousel').carousel('prev')
            });
        });
		
//更改模态框内容
function check(obj){
	var intro=obj.id.split("_");
	$("#intro").html("<center><h3>"+intro[0]+"</h3></center>");
	for(var i=1;i<=3;i++){
		if(i<=intro.length-1){
		
			$("#img"+i).attr('src','../back/app/'+intro[i]); 
		
		}
		else{
			$("#img"+i).attr('src','images/none.jpg'); 
		
		}
	}
	
}
//$('.carousel').carousel({ 	interval: 6000000 });

//隐藏模态框
   $(function () { $('#myModal').modal('hide')});




//增加减少订单逻辑判断
$(function(){
  $("input").click(function () {
   var method=$(this).attr("id");
	var id=method.split('_');		
			var a=$("#num_"+id[0]+"_add")[0].value;	
			//alert(a+1);
			if(method.indexOf('add')!=-1)
			{			
				if(a=="0"){
					$("#num_"+id[0]+"_add")[0].value = "1";
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
						//$('#'+id[0]+'_sub').hide();
					}
					else{
						a=Number(a)-1;
						$("#num_"+id[0]+"_add")[0].value=a;
					}
					
				}
					
});

var main_right_width = $('table').width();

$('#queding').width(main_right_width);





});


</script>


<div style="bottom:0;background-color:#F9F4F0;text-align:right;position:fixed;border-top:1px solid #DFD7D4;z-index:999" id="queding">
	<!--<button class="btn btn-success" onclick="location.href='../back/changeorder.php'" style="height:45px;width:100px;float:left">购物车</button>-->
	<a href="../back/changeorder.php"><img style="height:43px;width:43px;float:left;" src="images/shopping.png" ></a>
	<button  onclick="document.getElementById('formId').submit();" style="border:0;margin-right:10px;background: transparent;"><img style="height:43px;width:43px;" src="images/padnote.png"></button>
	
	
</div>
</body>
</html>
