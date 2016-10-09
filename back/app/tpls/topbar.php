
<ol class="breadcrumb" style="font-size:1.2em">
  <li><a href="#/index/main/welcome" >餐厅后台管理系统</a></li>
   <li><a ui-sref="index.search" ng-click="change($event)">搜索菜品</a></li>
    <li><a ui-sref="index.profit" ng-click="change($event)">查看收益</a></li>
  <li><a href="../../../../diancan/front">前台首页</a></li>
   <li>
        <?php
          session_start();
          if(isset($_SESSION['user'])){
              echo $_SESSION['nickname']."<a href='php/edit.php?action=zhuxiao'>注销</a>  <a  ui-sref='index.id.welcome' ng-click='change($event)'>管理</a>";
            } 
          else 
              echo '<a href="#" data-toggle="modal"  data-target="#myModal">登录/注册</a>';          
        ?>
   </li>
</ol>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:150px;" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              <h3 class="text-center"> <a href="#" onclick="login()">登录</a>   &nbsp&nbsp <a href="#" onclick="register()">注册</a>  </h3>
            </h4>
         </div>
         <div class="modal-body" ng-controller="login">

         <!-- 登录 -->
           <div style="padding:10px;padding-bottom:40px" id="login">
              <form role="form" action=""  class="login-form" >
                            <div class="form-group">
                            <label class="sr-only" for="form-username" >Username</label>
                            <input type="text" ng-model='user' placeholder="Username..." required  class="form-username form-control" >
                            </div>
                           
                            <div class="form-group">
      						  <label class="sr-only" for="form-password" >Password</label>
      						  <input type="password" ng-model="password" placeholder="Password..." required class="form-password form-control" >
      					  </div>
      					<div class="form-group">
      						 <label class="sr-only" for="form-code" >验证码</label>
      							<input type="text" ng-model="code" style="width:40%" class="form code form-control col-md-3"  id="code_num" name="code_num"  required placeholder="验证码"   maxlength="4" />
      							<img src="php/code_num.php" id="getcode_num" title="看不清，点击换一张"  ng-click="changecode()" width="60px" height="30px" >
      						</div>
							     <input type="button" ng-click="forgot_password()" class="btn btn-info " value="忘记密码">
                          <input type="submit" name="submit" ng-click="login()" class="btn btn-info pull-right" value="登录">
              </form>     
          </div>


           <!-- 注册 -->
           <div style="padding:10px;padding-bottom:40px;display:none" id="register">
              <form role="form" action=""  class="login-form"   >
                            <div class="form-group">
                            <label class="sr-only" for="form-username" >Username</label>
                            <input type="text" ng-model="register_user" placeholder="Username..." required  class="form-username form-control" >
                            </div>
                           
                            <div class="form-group">
                            <label class="sr-only" for="form-password" >Password</label>
                            <input type="password" ng-model="password1" placeholder="Password..." required class="form-password form-control" >
                          </div>
                            <div class="form-group">
                            <label class="sr-only" for="form-password" >Password</label>
                            <input type="password" ng-model="password2" placeholder="Confirm Password..." required class="form-password form-control" >
                          </div>
                          <input type="submit" name="register"  ng-click="register()" class="btn btn-info pull-right" value="注册">
              </form>     
            </div>
          
         </div>
         
      </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>