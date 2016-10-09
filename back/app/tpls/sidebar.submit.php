<?php 
require ("../php/check_login.php");
?>
<form role="form" action="php/upload.php" method="post" enctype="multipart/form-data" >
		<label for="name">类型</label>
		   <select class="form-control" name='type'>
		   <?php
		   require_once("../../db.func.php");
			$pdo=getConnection();
			$t=total("fenlei",$pdo);
			$sql="select * from fenlei";
			$data=select($sql,$pdo);
			for($i=0;$i<$t;$i++){
				echo "<option value=_".$data[$i]['type']."_".$data[$i]['shunxu']." >".$data[$i]['name']."</option>";
			}
		   ?>
      </select>
	
	菜名：<input type="text" name="name" placeholder="菜名" required class="form-control"><br/>
	价格<input type="text" name="price" placeholder="价格"  required class="form-control"><br/>
	介绍<input type="text" name="introduce" placeholder="介绍" required class="form-control"><br/>
	上传图片<input type="file" name="upfile" class="file" required><br/>
	<input type="submit" name="上传" value="上传" class="btn btn-info">
</form>


