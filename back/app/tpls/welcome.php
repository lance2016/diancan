<div class="jumbotron text-center">
    <h2>欢迎使用</h2>
    <p>
     <?php
          session_start();
          if(isset($_SESSION['user'])){
              echo '尊敬的'.$_SESSION['user'].',欢迎使用<span class="text-danger">餐厅</span>后台管理系统';
            } 
          else 
              echo '点击<a href="#" data-toggle="modal"  data-target="#myModal">登录/注册</a>';          
        ?>
        
        
    </p>
</div>