'use strict';

/**
 * @ngdoc overview
 * @name yunNavApp
 * @description
 * # yunNavApp
 *
 * Main module of the application.
 */
angular
  .module('yunNavApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/index.html',
        controller: 'IndexCtrl'
      })
      .when('/discover', {
        templateUrl: 'views/discover.html',
        controller: 'DiscoverCtrl'
      })
      .when('/article/:type', {
        templateUrl: 'views/article.html',
        controller: 'ArticleCtrl'
      })
      .when('/food', {
        templateUrl: 'views/food.html',
        controller: 'FoodCtrl'
      })
      .when('/restaurant/:id', {
        templateUrl: 'views/restaurant.html',
        controller: 'RestaurantCtrl'
      })
      .when('/shop', {
        templateUrl: 'views/shop.html',
        controller: 'ShopCtrl'
      })
      .when('/list/:type', {
        templateUrl: 'views/list.html',
        controller: 'ListCtrl'
      })
      .when('/notfound', {
        templateUrl: 'views/notfound.html',
        controller: 'NotfoundCtrl'
      })
      .when('/course', {
        templateUrl: 'views/course.html',
        controller: 'CourseCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
