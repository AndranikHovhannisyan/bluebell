'use strict';

angular.module('main', ['ngMaterial', 'ngAnimate', 'infinite-scroll', 'ngDialog'])
  .config(function($interpolateProvider){
    $interpolateProvider.startSymbol("[[");
    $interpolateProvider.endSymbol("]]");
  })
  .service('InfiniteItems',['$http', function($http){
    var InfiniteItems = function(loadCount) {
      this.items = [];
      this.busy = false;
      this.start = 0;
      this.count = loadCount ? loadCount : 7;
    };

    InfiniteItems.prototype.reset = function(){
      this.items = [];
      this.busy = false;
      this.start = 0;
    };

    InfiniteItems.prototype.nextItems = function(post, params){
      if(this.busy){
        return;
      }

      this.busy = true;

      $http({
        method: 'POST',
        url: '/app_dev.php/api/v1.0/products/' + this.start + '/' + this.count,
        data: post,
        params: params
      }).success(function(res){

        this.busy = res.length ? false : true;
        this.items = this.items.concat(res);
        this.start += this.count;

        }.bind(this));
    };

    return InfiniteItems
  }])
  .controller('MainCtrl', ['$scope',
    '$q',
    'InfiniteItems',
    'ngDialog',
    function($scope, $q, InfiniteItems, ngDialog){

    $scope.InfiniteItems = new InfiniteItems(9);

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

    $scope.openPopup = function(item){
      ngDialog.open({
        template: '/bundles/app/htmls/list_item.html',
        controller: function($scope, item, $timeout){
            $scope.item = item;

            $timeout(function(){
                var galleryTop = new Swiper('.gallery-top', {
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',
                    spaceBetween: 10
                });
                var galleryThumbs = new Swiper('.gallery-thumbs', {
                    spaceBetween: 10,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    touchRatio: 0.2,
                    slideToClickedSlide: true
                });
                galleryTop.params.control = galleryThumbs;
                galleryThumbs.params.control = galleryTop;

            }, 100);
        },
        resolve: {
          item: function(){
            return item;
          }
        },
        width: 780
      });
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

//    $scope.$watch('[products.selected, flowers.selected, colors.selected]', function(){
//      $scope.doFilter();
//    }, true);

    $scope.doFilter = function(){
      $scope.post = {
        products: $scope.products ? $scope.products.selected : null,
        flowers: $scope.flowers ? $scope.flowers.selected : null,
        colors: $scope.colors ? $scope.colors.selected : null
      };

      $scope.InfiniteItems.reset();
      $scope.InfiniteItems.nextItems($scope.post);

    };

    $scope.doFilter();
  }]);