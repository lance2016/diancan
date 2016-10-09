<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--定时刷新180s-->
<meta http-equiv="refresh" content="180">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<!--引用-->
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<!--引用结束-->
<title></title>
<link rel="stylesheet" href="../front/css/bootstrap.css" />
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
				margin-bottom:20px;
				border:solid 1px #EAE7DE;
				border-radius:15px;
				background-color:#FFF;
			}
		
    </style>

</head>


<body>
<?php 
require("../db.func.php");
$pdo=getConnection();
$sql="select * from user where finish=1 order by c_time";
$rs=select($sql,$pdo);
$sql2="select count(*) from user where finish=1";
$to=select($sql2,$pdo);
?>
<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
	<br>
	<span style="color:white;font-size:20px;"><b>收银管理</b></span>
</div>
<div style="height:100px"></div>

<div class="main">
    <button class="btn btn-info pull-right" onclick="history.go(0)">刷新</button>
		<div style="margin-top:30px;"></div>
     <?php for($i=0;$i<$to[0][0];$i++){?>
        <table style="width:100%;border:solid 1px #A69E9C;margin-bottom:30px;"> 
		<tr height="100px" style="font-size:1.3em;text-align:center">  <!--显示座位号-->	
              	 <?php echo "<td  id=".$rs[$i]['desk_num'].">桌号:".$rs[$i]['desk_num'];?></td>
             	 <?php echo "<td id=".$rs[$i]['c_sum'].">总价:".$rs[$i]['c_sum'];?></td>
                <?php echo"<td><button class='btn btn-success' onclick='finish(this.id)' style='height:40px;width:60px;'  id=".$rs[$i]['desk_num'].">收款</button></td>";?>
            </tr>
            <tr height="20px"  style="font-size:15px;">		 <!--显示表单信息-->
            	<td style="border-bottom:dotted 1px #000000">名称</td>
                <td style="border-bottom:dotted 1px #000000">数量</td>
                <td style="border-bottom:dotted 1px #000000">价格</td>	

            </tr>
            
         <?php 
            $arr=explode('_',$rs[$i]['cai_list']);//获取菜单列表
            $total=substr_count($rs[$i]['cai_list'],"_");//获取菜的数目
                for($j=1;$j<=$total;$j++){
            ?>
             <tr height="40px" style="font-size:18px;">  
                <td>  <?php  echo "$arr[$j]<br/>"; $j++;?></td>
                <td><?php echo $arr[$j];$j++; ?>份</td>
                <td><?php echo $arr[$j]."元/份"; ?></td>
            </tr> 
            
            <?php }?>
            
        </table>
    <?php   }?>
		
		
    </div>
	
	<!--模态框--->
 <div style="padding-top:200px;overflow-y:hidden;" class="modal fade" id="my" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width:80%; text-align:center; margin-left:10%">
				 <div class="modal-content">
						<div class="modal-header">
						</div>
					<div class="modal-body" style="font-size:20px;">
					收款成功
					</div>
					<div class="modal-footer" style="text-align:center">
					<button type="button" class="btn btn-default"  data-dismiss="modal" onclick="history.go(0)">确定</button>
					</div>
			  </div>
	</div>
	
	
<script type="text/javascript">
function finish(id){
    
         $.post('../edit.php',{'name':'paied','zhuohao':id},function(data){
            if(data==2)
           // alert("收款成功");
	   $('#my').modal('show');
                 //  window.location.reload();
            });
}
</script>
</body>
</html>

<?php ?>
