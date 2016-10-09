
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" />
<title>菜单</title>
<link rel="stylesheet" href="css/bootstrap.css" />
    <style type="text/css">
	body{
		padding:0;
		margin:0;
	}
	.ul_li{
		height:50px;
		text-align:center;
		line-height:50px;
		border-bottom:solid 1px #DFD7D4;
		color:#95887F;
		font-weight :bold
	}
	
	
    </style>
<script src="js/jquery.js"></script>


</head>


<body>
<div style="width:100%;text-align:center;height:60px;background-color:#352F31;position:fixed">
	<br>
	<span style="color:white;font-size:20px;"><b>点菜列表</b></span>
</div>
<div style="height:60px"></div>
<div id="main" style="height:2000px">
	<div id="main_left" style="float:left;width:27%;background-color:#F9F4F0; border-right:solid 1px #DFD7D4;height:100%;position:fixed;z-index:1">
	<?php
	session_start();
	require_once("../back/db.func.php");
	
	if(!isset($SESSION['desk_num']))
	{
		$id=$_GET['id'];
		if($id=="")
			;
		else
			$_SESSION['desk_num']=$id;	
	}
	$pdo=getConnection();
	$t=total("fenlei",$pdo);
	$sql="select * from fenlei order by shunxu desc";
	$data=select($sql,$pdo);
	//print_r($data);
		for($i=0;$i<$t;$i++)
		{
			echo "<div class='ul_li' id=v".$data[$i]['type'].">".$data[$i]['name']."</div>";
		}
		?>
	
		
		
	</div>
	<div id="main_left2" style="float:left;width:27%;background-color:#F9F4F0; border-right:solid 1px #DFD7D4;height:100%">

	</div>
	<div id="main_right" style="float:left;width:73%;background-color:#FFFEF9">
		
	</div>
	
	
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#main_right').load('menu.php');
var cai=['v1','v2','v3','v4','v5','v6','v7','v8'];
$('.ul_li').click(function(){
	var id = this.id;
	$('body,html').animate({scrollTop:$('#di'+id).offset().top-60},500);
})
});
</script>

<div style="position:fixed;bottom:0;width:100%;height:46px;background-color:#F9F4F0;z-index:998;border-top:1px solid #DFD7D4">


</div>
</body>
</html>

<?php ?>
