var myApp = angular.module('myApp', [
	'ui.router','myCtrls','myServices','myDirectives','ui.bootstrap'
]);

myApp.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/index/main/welcome');
    $stateProvider
        .state('index', {
            url: '/index',
            views: {
                '': {
                    templateUrl: 'tpls/index.php'
                },
                'topbar@index': {
                    templateUrl: 'tpls/topbar.php'
                },
                'main@index': {
                    templateUrl: 'tpls/main.php'
                },
            }
        })
		
		.state('index.main', {
            url: '/main',
            views: {
                'main@index': {
                    templateUrl: 'tpls/main.php'
                }
            }
        })
		
		//首页侧边栏
        .state('index.main.welcome', {
            url: '/welcome',
            templateUrl: 'tpls/welcome.php'
        })
		.state('index.main.submit', {
            url: '/submit',
            templateUrl: 'tpls/sidebar.submit.php'
        })
		 .state('index.main.editmenu', {
            url: '/editmenu',
            templateUrl: 'tpls/sidebar.editMenu.php'
        })
		
		
		//菜单编辑
        .state('index.main.rewrite', {
            url: '/rewrite:title',
                templateUrl: 'tpls/content.rewrite.php'
        })
		
		//类别编辑
        .state('index.main.classrewrite', {
            url: '/classrewrite:title',
                templateUrl: 'tpls/content.classrewrite.php'
        })
		
		//菜单分类
        .state('index.main.class', {
            url: '/class:title',
                templateUrl: 'tpls/sidebar.class.php'
        })
		
			//菜单添加分类
        .state('index.main.AddClass', {
            url: '/addclass',
                templateUrl: 'tpls/sidebar.class_add.php'
        })
		
		//切换到频道search
		.state('index.search', {
            url: '/search',
             views: {
                'main@index': {
                    templateUrl: 'tpls/topbar.search.php'
                }
            }
        })
		
			//切换到频道profit
		.state('index.profit', {
            url: '/profit',
             views: {
                'main@index': {
                    templateUrl: 'tpls/topbar.profit.php'
                }
            }
        })
		
		
		
		
		
		//切换到账号管理侧边栏
		.state('index.id', {
            url: '/id',
             views: {
                'main@index': {
                    templateUrl: 'tpls/topbar.manage_id.php'
                }
            }
        })
	
		//账号欢迎页
        .state('index.id.welcome', {
            url: '/welcome',
            templateUrl: 'tpls/welcome.php'
        })
		
		//账号修改密码
        .state('index.id.change', {
            url: '/welcome',
            templateUrl: 'tpls/topbar.manage_id.change.php'
        })
		//账修改账户
        .state('index.id.changeid', {
            url: '/welcome',
            templateUrl: 'tpls/topbar.manage_id.change_id.php'
        })
		
		
		
		
		//切换到频道书籍管理
		.state('index.article', {
            url: '/article',
             views: {
                'main@index': {
                    templateUrl: 'tpls/manageBook.php'
                }
            }
        })
		
		//编辑
        .state('index.rewrite', {
            url: '/rewrite/:title',
            views: {
                'main@index': {
                    templateUrl: 'tpls/content.rewrite.php'
                }
            }
        })	
		
		
		
		
	
		
		
		
		
		
		
});
  