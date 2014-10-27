'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('FoodCtrl', ['$scope', '$http', '$location', function ($scope, $http, $location) {
    $http.get('scripts/data/food.json').success(function (callback) {
      $scope.foods = callback.data;
    });
    $scope.arr = function (num) {
      var arr = []
      for (var i = 0; i < num; i++) {
        arr[i] = i;
      };
      return arr;
    };
    $scope.back = function () {
      $location.path('/');
    };
    $scope.searchState = false;
    $scope.toggleSearch = function () {
      $scope.searchState = !$scope.searchState;
    };
    $scope.color = function (index) {
      return index%4;
    };
    $scope.detail = function (id) {
      $location.path('/restaurant/'+id);
    };
  }]);
