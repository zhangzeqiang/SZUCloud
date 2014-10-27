'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('GlobalCtrl', ['$scope', '$location', function ($scope, $location) {   
    $scope.$on('$routeChangeSuccess', function (scope, current, before) {
      $scope.path = current.$$route.originalPath;
      if ($scope.path !== '/' && $scope.path !== '/discover') {
        $('footer').hide();
      } else {
        $('footer').show();
      }
    });
    $scope.barClose = function () {
      $('body').removeClass('bar-open');
      setTimeout(function () {
        $('body').removeClass('fixed');
        $('.cover').removeClass('show');
      }, 300);
    };
    $scope.menu = function (path) {
      $location.path(path);
    };
  }]);
