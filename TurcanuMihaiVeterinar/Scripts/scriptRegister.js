var app = angular.module('myApp');

app.controller('RegisterController', function ($scope, $rootScope, $stateParams, $state, RegisterService, commonService) {
	$rootScope.Title = "Înregistrare";
	$rootScope.head = null;
	$scope.formSubmit = function () {
		var mes = RegisterService.register($scope.username, $scope.password1, $scope.password2, $scope.email, $scope.date, commonService);
		if (mes == 'OK') {
			var user = {
				username: $scope.username,
				password: $scope.password1,
				email: $scope.email,
				date: $scope.date
			};
			console.log('Call SetUsers: ' + user.username);
			commonService.setUsers(user);
			$scope.error = '';
			$scope.username = '';
			$scope.password1 = '';
			$scope.password2 = '';
			$scope.email = '';
			$scope.date = '';
			$state.transitionTo('login');
		} else {
			$scope.error = mes;
		}
	};

});

app.factory('RegisterService', function () {
	var EMAIL_REGEXP = /^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

	return {
		register: function (username, pass1, pass2, email, date, commonService) {
			var users = commonService.getUsers();
			for (var i = 0; i < users.length; i++)
				if (users[i].username == username)
					return '  Nume utilizator ocupat !';
			if (pass1 === pass2)
				if (EMAIL_REGEXP.test(email))
					return 'OK';
				else return '  Email invalid !';
			else return '  Parolele nu coincid !';

			return '  Unhandled Error';
		}
	};

});