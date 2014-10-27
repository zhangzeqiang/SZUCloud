'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('ArticleCtrl', ['$scope', '$http', '$location', '$routeParams', function ($scope, $http, $location, $routeParams) {   
    var type = $routeParams.type;

    $http.get('scripts/data/' + type + '.json').success(function (callback) {
      $scope.data = callback.data;
    });
    $scope.back = function () {
      $location.path('/');
    };
    $scope.searchState = false;
    $scope.toggleSearch = function () {
      $scope.searchState = !$scope.searchState;
    };
  }]);
