<?php 
require ("../php/check_login.php");
?>
<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group" ng-controller="changeBgColor">
                    <a ui-sref="#" class="list-group-item active" >菜单管理</a>
					 <a ui-sref="index.main.submit" class="list-group-item" ng-click="change($event)">上传新菜</a>
		            <a ui-sref="index.main.editmenu" class="list-group-item" ng-click="change($event)">编辑菜单</a>
					<a ui-sref="index.main.class" class="list-group-item" ng-click="change($event)">菜单类别</a>
					<a ui-sref="index.main.AddClass" class="list-group-item" ng-click="change($event)">类别添加</a>
				</div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div ui-view></div>
    </div>
</div>
