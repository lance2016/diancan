<?php
?>
<!doctype html>
<html ng-app="myApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/alertify.core.css" /><!--提示消息-->
	<link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" /><!--提示消息-->
    <script src="framework/angular-1.3.0.js"></script>
    <script src="framework/angular-animate.js"></script>
    <script src="framework/angular-ui-router.js"></script>
    <script src="framework/jquery-1.12.1.min.js"></script>	
    <script src="framework/bootstrap.min.js"></script>
	<script src="framework/alertify.min.js"></script>	<!--提示消息-->

    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>

    <script src="js/directives.js"></script>
    <script src="js/filters.js"></script>
    <script src="js/services.js"></script>
	<script type="text/javascript" src="js/my.js"></script>  
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>  
	<script type="text/javascript" src="ckeditor/config.js"></script>  

    <script src="framework/ui-bootstrap-tpls.js"></script><!--bootstrap分页 -->
    <script src="http://www.my97.net/dp/My97DatePicker/WdatePicker.js"></script><!--日期 -->



   
 <script type="text/javascript" src="js/echarts.js"></script>  

</head>
<body >
    <div ui-view class="{{pageClass}}"></div>
</body>
</html>
