<?php 
require ("../php/check_login.php");
?>
<div ng-controller="AddClass">
	 <form role="form"   >
		
	<label for="name">分类名</label>
		<input type="text"   placeholder="类名"  ng-model='name'  required class="form-control" ><br/>
	<label for="name">顺序</label>
		<input type="number" ng-model="sort"  placeholder="顺序" required class="form-control" ><br/>
	<button ng-click="add()" class="btn btn-info">添加类别</button>
  	
</form>
</div>
