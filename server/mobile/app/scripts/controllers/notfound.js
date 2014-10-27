'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:NotfoundCtrl
 * @description
 * # NotfoundCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('NotfoundCtrl', ['$scope', '$window', function ($scope, $window) {
    $scope.back = function () {
      $window.history.go(-1);
    };
  }]);
