'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('RestaurantCtrl', ['$scope', '$http', '$location', '$routeParams', function ($scope, $http, $location, $routeParams) {   
    var id = $routeParams.id;
    $http.get('scripts/data/restaurant.json').success(function (callback) {
      var data = callback.data;
      for (var i = data.length - 1; i >= 0; i--) {
        if (id == data[i].id) {
          console.log('ok');
          $scope.data = data[i];
          break;
        }
      };
    });
    $scope.arr = function (num) {
      var arr = []
      for (var i = 0; i < num; i++) {
        arr[i] = i;
      };
      return arr;
    };
    $scope.back = function () {
      $location.path('/food');
    };
    $scope.tabState = true;
    $scope.changeState = function (state) {
      $scope.tabState = state;
    };
  }]);
