'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .controller('IndexCtrl', ['$scope', '$location', '$http', '$window', 'IndexSrv', function ($scope, $location, $http, $window, IndexSrv) {
    var store = $window.store,
        items = store.get('items1413817520000');

    IndexSrv.slider();

    if (items) {
      $scope.items = items;
    } else {
      $http.get('scripts/data/index.php').success(function (callback) {
        store.set('items1413817520000', callback.data);
        $scope.items = callback.data;
      });
    }
    
    $scope.redirect = function (item) {
      if (item.isNative) {
        $location.path(item.href);
      } else {
        $window.location.href = item.href;
      }
    };
    $scope.addItem = function () {
      $location.path('/discover');
    };
  }]);
