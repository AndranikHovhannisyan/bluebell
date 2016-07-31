'use strict';

angular.module('main', [])
  .controller('MainCtrl', ['$scope', function($scope){
    console.log("hello Ctrl");

    angular.element('.select-filter').select2();
  }]);