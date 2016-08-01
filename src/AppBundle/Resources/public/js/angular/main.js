'use strict';

angular.module('main', ['ngMaterial', 'ngAnimate'])
  .config(["$interpolateProvider",function($interpolateProvider){
    $interpolateProvider.startSymbol("[[");
    $interpolateProvider.endSymbol("]]");
  }])
  .controller('MainCtrl', ['$scope', '$q', function($scope, $q){
    console.log($scope, "hello Ctrl");

    $scope.products = {
      selected: [],
      items: ['Bucket', 'Composition', 'Single Flower']
    };

    $scope.initFlowers = function(flowers){
      $scope.flowers = {
        selected: [],
        items: angular.fromJson(flowers)
      };
    };

    $scope.initColors = function(colors){
      $scope.colors = {
        selected: [],
        items: angular.fromJson(colors)
      };
    };

    $scope.getProducts = function(q){
      var deferred = $q.defer();
      var res = [];
      var regex = new RegExp('^' + q + '.*$', 'i');

      for (var i = 0, l = $scope.products.items.length; i < l; i++) {
        if ($scope.products.items[i].match(regex)) {
          res.push($scope.products.items[i]);
        }
      }

      deferred.resolve(res);

      return deferred.promise;
    };

    $scope.getColors = function(q) {
      var deferred = $q.defer();
      var res = [];
      var regex = new RegExp('^' + q + '.*$', 'i');

      for (var i = 0, l = $scope.colors.items.length; i < l; i++) {
        if ($scope.colors.items[i].name.match(regex)) {
          res.push($scope.colors.items[i]);
        }
      }

      deferred.resolve(res);

      return deferred.promise;
    };

    $scope.getFlowers = function(q) {
      var deferred = $q.defer();
      var res = [];
      var regex = new RegExp('^' + q + '.*$', 'i');

      for (var i = 0, l = $scope.flowers.items.length; i < l; i++) {
        if ($scope.flowers.items[i].name.match(regex)) {
          res.push($scope.flowers.items[i]);
        }
      }

      deferred.resolve(res);

      return deferred.promise;
    };

  }]);