<?php 
require ("../php/check_login.php");
?>

<div ng-controller="Menushow">
<!--文章列表-->
<!--<a  class="btn btn-info" ng-click="LoadMore()">加载更多</a>	-->
 <div class="form-group">
	
<div>
<table  class="table table-hover mt20" style="text-align:center">
	<tr>
		<td>图片</td><td>菜名</td><td>单价(元)</td><td>简介</td><td>删除</td><td>编辑</td>
	</tr>
	<tr ng-repeat="x in datas" style="padding-top:25%">
		<td ><img src="{{x.img}}" width="60px" height="80px"></td>
		<td style="line-height:80px" >{{x.c_name}}</td>
		<td style="line-height:80px">{{x.c_price}} </td>
		<td style="line-height:80px">{{x.c_jieshao}}</td>
		<td style="line-height:80px;">
			<a ng-click="DeleteBook(x.c_name,x.img)">删除</a>
			<!-- <a href="php/edit.php?action=del&bookid={{x.bookid}}";>删除</a> -->
		</td>
		<td style="line-height:80px;">
			<a ui-sref="index.main.rewrite({title:x.c_name})"  >编辑</a>
		</td>
	</tr>
	
</table>
 <pagination  total-items="bigTotalItems" ng-model="bigCurrentPage" 
 max-size="maxSize" class="pagination-sm" boundary-links="true" rotate="false" num-pages="numPages">
 </pagination> 
      
     	
</div>
</div>

