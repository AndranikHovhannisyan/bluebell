'use strict';

angular.module('main', ['ngMaterial', 'ngAnimate'])
  .controller('MainCtrl', ['$scope', '$timeout', function($scope, $timeout){
    console.log("hello Ctrl");

    $scope.fruitNames = ['Apple', 'Banana', 'Orange'];
  }]);