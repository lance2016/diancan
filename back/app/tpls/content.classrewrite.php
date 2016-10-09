<?php 
include "../php/check_login.php";
?>
<div ng-controller='classReWriteArticle'>	
	<form role="form">

		<div class="form-group">
		  <input type="text" class="form-control" ng-show="false"  ng-model="Id"
			 placeholder="id">
	   </div>
	   
	   
	    <div class="form-group">
		  <label for="name">类别</label>
		  <input type="text" class="form-control" required  ng-model="name"
			 placeholder="请输入菜名">
	   </div>
	  
	  
	   <div class="form-group">
		  <label for="name">优先顺序（降序）</label>
		  <input type="text" class="form-control" required  ng-model="shunxu"
			 placeholder="请输入优先顺序">
	   </div>
	   
	   
	   
	  
	   <h1>&nbsp;</h1>
	   <button type="submit" class="btn btn-info pull-right" ng-click="Submit(Id,name,shunxu)">提交</button>
	</form>
</div>				

