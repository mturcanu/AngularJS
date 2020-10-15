var app = angular.module('myApp');

app.controller('HomeController', function ($scope, $rootScope, $stateParams, $state, totalizare) {
    $rootScope.Title = null;
    $rootScope.head = [
        { route: 'home', active: 'active', name: 'Home' },
        { route: 'lucrari', active: '', name: 'Animale Lecuite' }
    ];
    $scope.total = 0;
    $scope.servicii = [
        { nume: 'CONSULTATIE ZI (8:00 – 22:00)', pret: 100 },
        { nume: 'CONSULTATIE DE SPECIALITATE', pret: 150 },
        { nume: 'CONSULTATIE NOAPTE (22:00 – 8:00)', pret: 150 },
        { nume: 'EMITERE RETETA MEDICALA', pret: 20 },
        { nume: 'EMITERE RETETA TIMBRU SEC', pret: 35 },
        { nume: 'AMBULANȚA ZIUA (08:00 - 22:00)', pret: 200 },
        { nume: 'AMBULANȚA NOAPTEA (22:00 - 08:00)', pret: 250 },
        { nume: 'PET TAXI', pret: 150 },
        { nume: 'STATIONARE PET TAXI LEI/30minute', pret: 50 },
        { nume: 'CHIRURGIE DE SUPRAFATA', pret: 350 },
        { nume: 'CHIRURGIE GENERALA', pret: 1450 },
        { nume: 'CHIRURGIE ORTOPEDICA', pret: 1950 },
        { nume: 'STERILIZARE CAINE FEMELA', pret: 250 },
        { nume: 'STERILIZARE CAINE MASCUL', pret: 350 },
        { nume: 'STERILIZARE FELINA', pret: 400 }
    ];
    $scope.basket = [];
    $scope.pushToBasket = function (x) {
        if ($scope.basket.indexOf(x) == -1) {
            $scope.basket.push(x);
            $scope.total = totalizare.calculeaza($scope.basket);
        }
    };
    $scope.removeFromBasket = function (x) {
        var index = $scope.basket.indexOf(x);
        $scope.basket.splice(index, 1); 
        $scope.total = totalizare.calculeaza($scope.basket);
    };
});

app.service('totalizare', function () {
    var total = 0;
    this.calculeaza = function (basket) {
        total = 0;
        for (var i = 0; i < basket.length; i++) {
            total += basket[i].pret;
        }
        return total;
    }
});
