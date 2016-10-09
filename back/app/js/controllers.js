var myCtrls = angular.module('myCtrls',[]);
//登录
myCtrls.controller('login', function($scope,$http,$state) {
	var bool=false;
$scope.login=function(){
	if($scope.user==null||$scope.password==null||$scope.code==null)
				;
	else{
		
		 $http({
					method:'GET',
					url:"php/chk_code.php",
					params: {code:$scope.code}//show操作
				})
				.success(function(data,status,headers,config){
					if(data=="1")
					{
						
							{
								 $http({
												method:'GET',
												url:"php/edit.php",
												params: {action:"login",user:$scope.user,password:$scope.password}//show操作
											}).success(function(data,status,headers,config){
												//data = angular.fromJson(data);	
												//$scope.datas= data;
												if(data=="登陆成功")
												{
													$('#myModal').modal('hide');
													history.go(0);
												}
												else 
												{
													$scope.changecode();
													alertify.error("账号或密码错误");
												}				
											}).error(function(){
										}); 
									
							}		
				
								
					}
					else{
							$scope.changecode();
							alertify.error("验证码错误");
							
						}
						
				}).error(function(){
				});  
			
	
}}

$scope.changecode=function(){
	var srcc='php/code_num.php?' + Math.random()
	document.getElementById("getcode_num").src=srcc;

}
//注册

$scope.register=function(){
	if($scope.register_user==null||$scope.password1==null||$scope.password2==null)
				;
	else{
		 $http({
												method:'GET',
												url:"php/edit.php",
												params: {
														action:"register",
														user:$scope.register_user,
														password1:$scope.password1,
														password2:$scope.password2
														}//show操作
											}).success(function(data,status,headers,config){
												
												if(data=="注册成功")
												{	
													$('#myModal').modal('hide');
													alertify.success(data);
												}
												else 
												{
													alertify.error(data);
												}				
											}).error(function(){
										}); 									
	}
}


$scope.forgot_password=function(){
	alert("请联系管理员");
}


});

//账号管理
myCtrls.controller('manage_id',['$stateParams','$scope','$http','$state','msgBox',
	function($stateParams,$scope,$http,$state,msgBox){
		
		$scope.change_id=function(){
					$http({
							method:'GET',
							url:"php/edit.php",
							params: {
										action:"change_id",
										id: $scope.id,
										name:$scope.name				
									}
						})
				.success(function(data, status) {
					$scope.status = status;
					$scope.data = data;
					$scope.result = data; // Show result from server in our <pre></pre> element
					if($scope.result=="失败")
					{
						
						alertify.error("修改失败");
					}
						
					else 
					{
						alertify.success("修改成功");
						setTimeout(function(){	history.go(0);},500);
					}
				})
				.
				error(function(data, status) {
					$scope.data = data || "Request failed";
					$scope.status = status;			
				});
				}
				
				
		$scope.change_password=function(){
					$http({
							method:'GET',
							url:"php/edit.php",
							params: {
										action:"change_password",
										id: $scope.id,
										psw1:$scope.psw1,	
										psw2:$scope.psw2									
									}
						})
				.success(function(data, status) {
					$scope.status = status;
					$scope.data = data;
					$scope.result = data; // Show result from server in our <pre></pre> element
					if($scope.result=="修改成功")
					{
						alertify.success("修改成功");
						
					}
						
					else 
					{
						alertify.error(data);
					}
				})
				.
				error(function(data, status) {
					$scope.data = data || "Request failed";
					$scope.status = status;			
				});
		}
	}]);








//搜索
myApp.controller('SearchCtrl',function SearchCtrl($scope, $http,$state) {
	
		$scope.show=false;
		$scope.select="all";
		$scope.search = function() {
		$scope.show=true;
		$http({
					method:'GET',
					url:"php/edit.php",
					params: {
								action:"search",
								select: $scope.select,
								keywords:$scope.keywords				
							}//查找操作
				})
		.success(function(data, status) {
			$scope.status = status;
			$scope.data = data;
			$scope.result = data; // Show result from server in our <pre></pre> element
			if($scope.result=="失败")
			{
				$scope.result="";
				alertify.error("查找失败");
			}
				
			else 
			{
				alertify.success("查找成功");
				
			}
		})
		.
		error(function(data, status) {
			$scope.data = data || "Request failed";
			$scope.status = status;			
		});
	};
	
	
	//删除菜
	$scope.Delete = function(id,src){
		//	reset();
			var r = alertify.confirm("确定要删除 <strong>"+id+"</strong> 吗?",function (e){
				if (e) {
					$http({
						method:'GET',
						url:'php/edit.php',
						params: {action:"del",title:id,src:src}
					}).success(function(data,status,headers,config){
						alertify.success("删除成功a");
						
							setTimeout(function(){	history.go(0);},500);
							
															
					}).error(function(data,status,headers,config){
						alertify.error("删除失败,请检查网络连接");
					});						
				} else {
					
					alertify.error("操作取消a");
				}
			}); 			
		}
		$scope.LoadMore = function(){
			$scope.datas=saveData;
		}
});



//菜单管理
myApp.controller('Menushow',['$scope','$http','$state',
	function SearchCtrl($scope, $http, $state,$route) {
		
		var num;
		 $scope.maxSize = 7;    // 显示最大页数
        $scope.totalItems = 10000; // 总条数
        $scope.currentPage = 1;//当前页取值
        $scope.bigTotalItems = 20;
        $scope.bigCurrentPage = 1;
		
		$scope.getNum = function(){
			$http({
				method:'GET',
				url:"php/edit.php",
				params: {action:"showTotal",db:'caidan'}//查询总记录条数
			}).success(function(data,status,headers,config){
				num=data;
			}).error(function(){
			}); 
		}
		$scope.getNum();
		
		$scope.getBook = function(){
			$http({
				method:'GET',
				url:"php/edit.php",
				params: {action:"show",db:'caidan',pageNo:($scope.bigCurrentPage-1)*4,pageSize:4}//show操作
			}).success(function(data,status,headers,config){
				data = angular.fromJson(data);				
			$scope.bigTotalItems = (num/4)*10;//默认每页10条，此处转换为每页4条		
			//	saveData=data;
					//data = data.slice(($scope.bigCurrentPage-1)*4,$scope.bigCurrentPage*4);//每页显示4条
					$scope.datas= data;
					
			}).error(function(){

			}); 
		}
		$scope.getBook();
		var watch = $scope.$watch('bigCurrentPage',function(newValue,oldValue, scope){
				setTimeout(function(){$scope.getBook();},500);
});
		
	//删除
	$scope.DeleteBook = function(id,src){
		//	reset();
			var r = alertify.confirm("确定要删除 <strong>"+id+"</strong> 吗?",function (e){
				if (e) {
					$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"del",
							db:'caidan',
							title:id,
							src:src}
					}).success(function(data,status,headers,config){
							$scope.getBook();
						alertify.success("删除成功啦");	
					}).error(function(data,status,headers,config){
						alertify.error("删除失败,请检查网络连接");
					});						
				} else {					
					alertify.error("操作取消吗");
				}
			}); 			
		}
		
	
}]);


//类别管理
myApp.controller('Menuclass',['$scope','$http','$state',
	function SearchCtrl($scope, $http, $state,$route) {
		
		var num;
		 $scope.maxSize = 7;    // 显示最大页数
        $scope.totalItems = 10000; // 总条数
        $scope.currentPage = 1;//当前页取值
        $scope.bigTotalItems = 20;
        $scope.bigCurrentPage = 1;
		
		$scope.getNum = function(){
			$http({
				method:'GET',
				url:"php/edit.php",
				params: {action:"showTotal",db:'fenlei'}//查询总记录条数
			}).success(function(data,status,headers,config){
				num=data;
			}).error(function(){
			}); 
		}
		$scope.getNum();
		
		$scope.getBook = function(){
			$http({
				method:'GET',
				url:"php/edit.php",
				params: {action:"show",db:'fenlei',pageNo:($scope.bigCurrentPage-1)*4,pageSize:4}//show操作
			}).success(function(data,status,headers,config){
				data = angular.fromJson(data);				
			$scope.bigTotalItems = (num/4)*10;//默认每页10条，此处转换为每页4条		
			//	saveData=data;
					//data = data.slice(($scope.bigCurrentPage-1)*4,$scope.bigCurrentPage*4);//每页显示4条
					$scope.datas= data;
					
			}).error(function(){

			}); 
		}
		$scope.getBook();
		var watch = $scope.$watch('bigCurrentPage',function(newValue,oldValue, scope){
				setTimeout(function(){$scope.getBook();},500);
});
		
	//删除
	$scope.DeleteBook = function(id,name){
		//	reset();
			var r = alertify.confirm("确定要删除 <strong>"+name+"</strong> 吗?<br/>删除将删除该类别下的所有菜品",function (e){
				if (e) {
					$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"del",
							db:'fenlei',
							title:id,
							src:name}
					}).success(function(data,status,headers,config){
							$scope.getBook();
						alertify.success("删除成功");	
					}).error(function(data,status,headers,config){
						alertify.error("删除失败,请检查网络连接");
					});						
				} else {					
					alertify.error("操作取消");
				}
			}); 			
		}
		
	
}]);






//编辑菜单
myCtrls.controller('ReWriteArticle',['$stateParams','$scope','$http','$state','msgBox',
	function($stateParams,$scope,$http,$state,msgBox){
			
			$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"editbook",
							db:'caidan',
							title:$stateParams.title
							}
					})
			.success(function(data,status,headers,config){
			
				$scope.c_id=data[0].c_id;
				$scope.c_name=data[0].c_name;
				$scope.c_price=data[0].c_price;
				$scope.c_jieshao=data[0].c_jieshao;
				$scope.img=data[0].img;
				$scope.c_type=data[0].c_type;

				alertify.success("加载完成");
				
			}).error(function(data,status,headers,config){
			}); 			
	

		 $scope.Submit = function(c_id,c_name,c_price,c_jieshao,img,c_type){			
		
			$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"update",
							db:"caidan",
							c_id:c_id,
							c_name:c_name,
							c_price:c_price,
							c_jieshao:c_jieshao,
							img:img,
							c_type:c_type}
					}).success(function(data,status,headers,config){

				if(data=="更新成功")
					alertify.success(data);
				else
				{
					alertify.error(data);
					$scope.title=data;
				}
			}).error(function(data,status,headers,config){
			});  
			setTimeout(function(){$state.go('index.main.manageBook')},500);
		}

	}
]);


//编辑菜单分类
myCtrls.controller('classReWriteArticle',['$stateParams','$scope','$http','$state','msgBox',
	function($stateParams,$scope,$http,$state,msgBox){	
			$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"editbook",
							db:"fenlei",
							title:$stateParams.title
							}
					})
			.success(function(data,status,headers,config){
					//alert(data);
				$scope.Id=data[0].Id;
				$scope.name=data[0].name;
				$scope.shunxu=data[0].shunxu;
				
				alertify.success("加载完成");
				
			}).error(function(data,status,headers,config){
			}); 			
	

		 $scope.Submit = function(id,name,shunxu){			
		
			$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"update",
							db:"fenlei",
							id:id,
							name:name,
							shunxu:shunxu
							}
					}).success(function(data,status,headers,config){

				if(data=="更新成功")
					alertify.success(data);
				else
				{
					alertify.error(data);
					$scope.title=data;
				}
			}).error(function(data,status,headers,config){
			});  
			setTimeout(function(){$state.go('index.main.class')},500);
		}

	}
]);




//菜单类别添加
myCtrls.controller('AddClass',['$stateParams','$scope','$http','$state','msgBox',
	function($stateParams,$scope,$http,$state,msgBox){	
		
		 $scope.add = function(){	
			if($scope.sort>0&&$scope.sort<100000){
				
			
			$http({
						method:'GET',
						url:'php/edit.php',
						params: {
							action:"add_class",
							db:"fenlei",
							name:$scope.name,
							sort:$scope.sort
							}
					}).success(function(data,status,headers,config){

				if(data=="添加成功")
					alertify.success(data);
				else
				{
					alertify.error(data);
					$scope.title=data;
				}
			}).error(function(data,status,headers,config){
			});  
			//setTimeout(function(){$state.go('index.main.class')},500);
		}
		else ;
		 }
		
	}
]);



//收益
myCtrls.controller('lineCtrl', function($scope,$rootScope,$http) {  
 
	
    
  
  
  
  
    
});  
  
  
myCtrls.directive('line', function() {  
    return {  
        scope: {  
            id: "@",  
            legend: "=",  
            item: "=",  
            data: "=" 
        },  
        restrict: 'E',  
        template: '<div style="height:400px;"></div>',  
        replace: true,  
        link: function($scope, element, attrs, controller) {  
		  
            var option = {
    title: {
        text: '最近七天营收',
       // subtext: '纯属虚构'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['最高','最低']
    },
    toolbox: {
        show: true,
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            dataView: {readOnly: false},
            magicType: {type: ['line', 'bar']},
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis:  {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value',
        axisLabel: {
            formatter: '{value} ￥'
        }
    },
    series: [
        {
            name:'收入',
            type:'line',
            data:[1100, 1201, 1500, 1233, 1222, 1213, 1220],
            markPoint: {
                data: [
                    {type: 'max', name: '最大值'},
                    {type: 'min', name: '最小值'}
                ]
            },
            markLine: {
                data: [
                    {type: 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'利润',
            type:'line',
            data:[500, 405, 423, 555, 443, 421, 568],
          
            markLine: {
                data: [
                    {type: 'average', name: '平均值'},
                    [{
                        symbol: 'none',
                        x: '90%',
                        yAxis: 'max'
                    }, {
                        symbol: 'circle',
                        label: {
                            normal: {
                                position: 'start',
                                formatter: '最大值'
                            }
                        },
                        type: 'max',
                        name: '最高点'
                    }]
                ]
            }
        }
    ]
};
  
            var myChart = echarts.init(document.getElementById($scope.id),'macarons');  
            myChart.setOption(option);  
        
   
	}	
	 }; 
});  

//改变a标签的颜色(仅用于本项目，由于bootstrap的样式冲突，所以很捉急-_-!)
myCtrls.controller('changeColor',['$scope',
	function($scope){
		$scope.change = function($event){
			$($event.target).parent().siblings().find('a').removeClass("a-color-active");
			$($event.target).parent().siblings().find('a').addClass("a-color");
			$($event.target).addClass("a-color-active");
		}
	}
]);
//改变a标签的背景颜色(仅用于本项目，由于bootstrap的样式冲突，所以很捉急-_-!)
myCtrls.controller('changeBgColor',['$scope',
	function($scope){
		$scope.change = function($event){
			$($event.target).siblings().removeClass("a-bgcolor-active");
			$($event.target).siblings().addClass("a-bgcolor");
			$($event.target).addClass("a-bgcolor-active");
		}	
	}
]); 
 