<?php 
require ("../php/check_login.php");
?>

<div ng-controller='manage_id'>	
   <form role="form"   >
		
	<label for="name">账号</label>
		<input type="text"   placeholder="id"  ng-model='id' <?php echo 'ng-init="id='."'".$_SESSION['user']."'".'"'; ?>   disabled required class="form-control" ><br/>
	<label for="name">密码</label>
		<input type="password"  ng-model="psw1"  required class="form-control" ><br/>
	<label for="name">确认密码</label>
		<input type="password"  ng-model="psw2" placeholder="确认密码" required class="form-control"><br/>
			<button ng-click="change_password()" class="btn btn-info">修改密码</button>
  	
</form>
</id>
