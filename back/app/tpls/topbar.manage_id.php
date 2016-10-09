<?php 
require ("../php/check_login.php");
?>

<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group" ng-controller="changeBgColor">
                    <a ui-sref="#" class="list-group-item active" >账号管理</a>
					 <a ui-sref="index.id.change" class="list-group-item" ng-click="change($event)">修改密码</a>
		            <a ui-sref="index.id.changeid" class="list-group-item" ng-click="change($event)">修改账户</a>
		
				
				</div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div ui-view></div>
    </div>
</div>
