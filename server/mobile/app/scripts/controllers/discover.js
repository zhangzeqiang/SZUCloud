'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('DiscoverCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {
    var store = $window.store,
        items = store.get('items1413817520000');

    if (items) {
      $scope.lists = items;
    } else {
      $http.get('scripts/data/index.json').success(function (callback) {
        store.set('items1413817520000', callback.data);
        $scope.lists = callback.data;
      });
    }

    $scope.changeState = function (index) {
      $scope.lists[index].isAdd = !$scope.lists[index].isAdd;
      store.set('items1413817520000', angular.copy($scope.lists));
    };
  }]);
