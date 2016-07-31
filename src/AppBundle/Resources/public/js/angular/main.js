'use strict';

angular.module('main', [])
  .controller('MainCtrl', ['$scope', function($scope){
    console.log("hello Ctrl");

    angular.element('.category1').select2({
      placeholder: "Տեսակ"
    });
    angular.element('.category2').select2({
      placeholder: "Ծաղիկներ"

    });
    angular.element('.category3').select2({
      placeholder: "Գույներ"

    });
  }]);