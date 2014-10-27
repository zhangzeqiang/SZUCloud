'use strict';

/**
 * @ngdoc function
 * @name yunNavApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yunNavApp
 */
angular.module('yunNavApp')
  .service('IndexSrv', [function () {
    var slider = function () {
      var bullets = $('.bullets'),
          slider = $('.slider'),
          str = '';
      for (var i = 0, l = slider.length; i < l; i++) {
          if (i === 0) {
            str += '<div class="active"></div>';
          } else {
            str += '<div></div>';
          }
      };
      bullets.append($(str));
      new Swipe(document.getElementById('sliders'), {
        startSlide: 0,
        speed: 400,
        auto: 3000,
        continuous: true,
        disableScroll: false,
        stopPropagation: false,
        callback: function(index, elem) {
          var bullet = bullets.find('div');
          bullet.removeClass('active');
          bullet.eq(index).addClass('active');
        }
      });
    };
    return {
      slider: slider
    };
  }]);
