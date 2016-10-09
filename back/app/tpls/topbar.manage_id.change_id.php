<?php 
require ("../php/check_login.php");
?>

<div ng-controller='manage_id'>	
   <form role="form"   >
		
	<label for="name">昵称</label>
		<input type="text"   placeholder="昵称"  ng-model='name' <?php echo 'ng-init="name='."'".$_SESSION['nickname']."'".'"'; ?>   required class="form-control" ><br/>
		<input type="hidden"   ng-model='id' <?php echo 'ng-init="id='."'".$_SESSION['user']."'".'"'; ?>   class="form-control" ><br/>
  	<button ng-click="change_id()" class="btn btn-info">修改昵称</button>
</form>
</id>
