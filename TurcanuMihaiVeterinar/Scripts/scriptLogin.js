var app = angular.module('myApp');

    app.controller('LoginController', function ($scope, $rootScope, $stateParams, $state, LoginService, commonService) {
        $rootScope.Title = "Autentificare";
        $rootScope.head = null;
        console.log('Lista de useri ');
        for (var i = 0; i < commonService.getUsers().length; i++){
            console.log(commonService.getUsers()[i].username);
        }
        $scope.formSubmit = function () {
            if (LoginService.login($scope.username, $scope.password, commonService, $rootScope)) {
                $scope.error = '';
                $scope.username = '';
                $scope.password = '';
                $state.transitionTo('home');
            } else {
                $scope.error = "  Nume utilizator/parolă greșită !";
            }
        };

    });

    app.factory('LoginService', function () {
        var isAuthenticated = false;

        return {
            login: function (username, password, commonService, $rootScope) {
                var users = commonService.getUsers();
                isAuthenticated = false;
                for (var i = 0; i < users.length; i++)
                    if (username === users[i].username && password === users[i].password) {
                        $rootScope.LoggedIn = users[i];
                        isAuthenticated = true;
                        return isAuthenticated;
                    }
                return isAuthenticated;
            },
            isAuthenticated: function () {
                return isAuthenticated;
            }
        };

    });