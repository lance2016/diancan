<?php 
include "../php/check_login.php";
?>
<div ng-controller='ReWriteArticle'>	
	<form role="form">

		<div class="form-group">
		  <input type="text" class="form-control" ng-show="false"  ng-model="c_id"
			 placeholder="id">
	   </div>
	   <div class="form-group">
		  <input type="text" class="form-control" ng-show="false"  ng-model="img"
			placeholder="请输入价格">
	   </div>
	   
	   
	    <div class="form-group">
		  <label for="name">菜名</label>
		  <input type="text" class="form-control" required  ng-model="c_name"
			 placeholder="请输入菜名">
	   </div>
	  
	  <div class="form-group">
		  <label for="name">价格(元)</label>
		  <input type="text" class="form-control" required  ng-model="c_price"
			 placeholder="请输入价格">
	   </div>
	   <div class="form-group">
		  <label for="name">介绍</label>
		  <input type="text" class="form-control" required  ng-model="c_jieshao"
			 placeholder="请输入介绍">
	   </div>
	   
	   <label for="name">类型</label>
		   <select class="form-control" ng-model='c_type'>
		   <?php
		   require_once("../../db.func.php");
			$pdo=getConnection();
			$t=total("fenlei",$pdo);
			$sql="select * from fenlei";
			$data=select($sql,$pdo);
			for($i=0;$i<$t;$i++){
				echo "<option value=".$data[$i]['type']." >".$data[$i]['name']."</option>";
			}
		   ?>
      </select>
	   
	  
	   <h1>&nbsp;</h1>
	   <button type="submit" class="btn btn-info pull-right" ng-click="Submit(c_id,c_name,c_price,c_jieshao,img,c_type)">提交</button>
	</form>
</div>				

