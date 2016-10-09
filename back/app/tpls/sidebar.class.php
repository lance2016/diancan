<?php 
require ("../php/check_login.php");
?>
<div ng-controller="Menuclass">
	<table  class="table table-hover mt20" style="text-align:center">
		<tr>
			<td>Id</td><td>类别</td><td>顺序(降序)</td><td>删除</td><td>编辑</td>
		</tr>
		<tr ng-repeat="x in datas" style="padding-top:25%">
			
			<td style="line-height:80px" >{{x.Id}}</td>
			<td style="line-height:80px">{{x.name}} </td>
			<td style="line-height:80px">{{x.shunxu}}</td>
			<td style="line-height:80px;">
				<a ng-click="DeleteBook(x.Id,x.name)">删除</a>
				<!-- <a href="php/edit.php?action=del&bookid={{x.bookid}}";>删除</a> -->
			</td>
			<td style="line-height:80px;">
				<a ui-sref="index.main.classrewrite({title:x.Id})"  >编辑</a>
			</td>
		</tr>
	</table>
	
	<pagination  total-items="bigTotalItems" ng-model="bigCurrentPage" 
 max-size="maxSize" class="pagination-sm" boundary-links="true" rotate="false" num-pages="numPages">
 </pagination> 
</div>
