'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:ListCtrl
 * @description
 * # ListCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('ListCtrl', ['$scope', '$http', '$routeParams', '$location', function ($scope, $http, $routeParams, $location) {
    var type = $routeParams.type;
    $http.get('scripts/data/' + type + '.json').success(function (callback) {
      $scope.data = callback.data;
    });
    $scope.barOpen = function () {
      $('body').addClass('fixed bar-open');
      $('.cover').addClass('show');
    };
    $scope.back = function () {
      $location.path('/shop');
    };
    $scope.buy = function () {
      $location.path('/notfound');
    };
  }]);
