<?php 
require ("../php/check_login.php");
?>	
<div  ng-controller="SearchCtrl">
   <form class="bs-example bs-example-form" role="form">
      <div class="row col-md-offset-0">
			<div class="col-md-2">
				<select class="form-control" ng-model='select'>
					 <option value="all" >全部</option>
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
			</div>
         <div class="col-md-4">
            <div class="input-group">
               <input type="text" ng-model="keywords" class="form-control">
               <span class="input-group-btn">
                 <button type="submit" class="btn btn-info" ng-click="search()">搜索</button>
               </span>
            </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
   </form>
   
   <table class="table"  ng-show="show" style="text-align:center">
		<tr>
		<td>图片</td><td>菜名</td><td>单价(元)</td><td>简介</td><td>删除</td><td>编辑</td>
		</tr>
		<tr ng-repeat="x in result">
			<td ><img src="{{x.img}}" width="60px" height="80px"></td>
		<td style="line-height:80px">{{x.c_name}}</td>
		<td style="line-height:80px">{{x.c_price}}</td>
		<td style="line-height:80px">{{x.c_jieshao}}</td>
		
		<td style="line-height:80px">
			<a ng-click="Delete(x.title,x.src)">删除</a>
			<!-- <a href="php/edit.php?action=del&bookid={{x.bookid}}";>删除</a> -->
		</td>
		<td style="line-height:80px">
			<a ui-sref="index.rewrite({title:x.title})" >编辑</a>
		</td>
		</tr>
	</table>
</div>
   
  