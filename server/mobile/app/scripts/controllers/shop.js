'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:ShopCtrl
 * @description
 * # ShopCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('ShopCtrl', ['$scope', '$http', '$location', function ($scope, $http, $location) {
    $http.get('scripts/data/shop.json').success(function (callback) {
      $scope.data = callback.data;
    });
    $scope.barOpen = function () {
      $('body').addClass('fixed bar-open');
      $('.cover').addClass('show');
    };
    $scope.back = function () {
      $location.path('/');
    };
    $scope.redirect = function (type) {
      $location.path('/list/'+type);
    }
  }]);
