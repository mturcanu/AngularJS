(function () {
    var app = angular.module('myApp', ['uiRouterStyles']);

    app.run(function ($rootScope, $location, $state, LoginService) {
        console.clear();
        console.log('running');
        $rootScope.head = [
            { route: 'home', active: 'class="active"', name: 'Home' },
            { route: 'lucrari', active: '', name: 'Lucrări Efectuate' }
        ];
        $rootScope.LoggedIn = null;
        if (!LoginService.isAuthenticated()) {
            $state.transitionTo('login');
        }
    });

    app.controller('BarController', function ($scope) {
        
    });

    app.controller('UserController', function ($scope, $rootScope, $stateParams, $state) {
        $scope.modalShown = false;
        $scope.toggleModal = function () {
            $scope.modalShown = !$scope.modalShown;
        }; 
    });

    app.config(['$stateProvider', '$urlRouterProvider',
        function ($stateProvider, $urlRouterProvider) {
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'login.html',
                    controller: 'LoginController',
                    data: {
                        css: 'styleLogin.css'
                    }
                })
                .state('home', {
                    url: '/home',
                    templateUrl: 'home.html',
                    controller: 'HomeController',
                    data: {
                        css: 'stylesHome.css'
                    }
                })
                .state('lucrari', {
                    url: '/lucrari',
                    templateUrl: 'lucrari.html',
                    controller: 'LucrariController',
                    data: {
                        css: 'styleLucrari.css'
                    }
                })
                .state('register', {
                    url: '/register',
                    templateUrl: 'register.html',
                    controller: 'RegisterController',
                    data: {
                        css: 'styleLogin.css'
                    }
                });

            $urlRouterProvider.otherwise('/login');
        }]);

    app.service('commonService', function ($http) {

        var users = [
            { username: 'admin', password: 'pass', email: 'admin@email.com', date: new Date(1476873429) }
        ];

        return {
            getUsers: getUsers,
            setUsers: setUsers
        };

        // .................

        function getUsers() {
            return users;
        }

        function setUsers(value) {
            console.log('SetUsers: ' + value.username);
            users.push(value);
        }
    });

    app.directive('modalDialog', function ($state) {
        return {
            restrict: 'E',
            scope: {
                show: '='
            },
            template: `
    <div class="ng-modal" ng-show="show">
        <div class="ng-modal-overlay" ng-click="hideModal()"></div>
      <div class="ng-modal-dialog" ng-style="dialogStyle">
        <div class="ng-modal-close" ng-click="hideModal()">X</div>
        <div class="ng-modal-dialog-content" ng-transclude>
        </div>    
      </div>
      </div>
    `,
            transclude: true,
            link: function (scope, elem, attrs) {
                scope.dialogStyle = {};
                if (attrs.width) {
                    scope.dialogStyle.width = attrs.width;
                }
                if (attrs.height) {
                    scope.dialogStyle.height = attrs.height;
                }
                scope.hideModal = function () {
                    scope.show = false;
                };
            }
        }
    });

})();