var app = angular.module('myApp');

app.controller('LucrariController', function ($scope, $rootScope, $stateParams, $state) {
	$rootScope.Title = null;
	$rootScope.head = [
		{ route: 'home', active: '', name: 'Home' },
		{ route: 'lucrari', active: 'active', name: 'Animale Lecuite' }
	];

	$scope.lucrari = [
		{ image: '../Images/lucrari/cat1.jpg', text: 'Cleo' , type: 'Pisica'},
		{ image: '../Images/lucrari/dog1.jpg', text: 'Bart' , type: 'Caine' },
		{ image: '../Images/lucrari/horse1.jpg', text: 'Bruno', type: 'Cal' },
		{ image: '../Images/lucrari/parrot1.jpg', text: 'Peter', type: 'Papagal' },
		{ image: '../Images/lucrari/horse2.jpg', text: 'CutiePie', type: 'Cal' },
		{ image: '../Images/lucrari/dog2.jpg', text: 'Robbert', type: 'Caine' },
		{ image: '../Images/lucrari/parrot2.jpg', text: 'Bobby', type: 'Papagal' },
		{ image: '../Images/lucrari/parrot3.jpg', text: 'Clarisa', type: 'Papagal' },
		{ image: '../Images/lucrari/cat2.jpg', text: 'Lola', type: 'Pisica' },
		{ image: '../Images/lucrari/horse3.jpg', text: 'Rex', type: 'Cal' },
		{ image: '../Images/lucrari/horse4.jpg', text: 'Tom', type: 'Cal' }
	];

	$scope.tipuri = [
		{ name: 'Pisica'},
		{ name: 'Caine'},
		{ name: 'Papagal'},
		{ name: 'Cal'}
	];

	$scope.filterItems = {
		'Pisica': true,
		'Caine': true,
		'Papagal': true,
		'Cal': true
	};

	$scope.tipFiltru = function (x) {
		return $scope.filterItems[x.type];
	};
	$scope.setOrder = function (orderProp) {
		$scope.orderProp = orderProp;
	};
});