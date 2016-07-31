'use strict';

angular.module('main', [])
  .controller('MainCtrl', ['$scope', '$timeout', function($scope, $timeout){
    console.log("hello Ctrl");

    angular.element('.category1').select2({
      placeholder: "Տեսակ"
    });
    angular.element('.category2').select2({
      placeholder: "Ծաղիկներ"

    });
    angular.element('.category3').select2({
      placeholder: "Գույներ",
      templateResult: function (item) {
        if (!item.id) { return item.text; }
        return $('<p>'+item.text+'<span class="color" style="background-color: red"></span></p>');
      },
      templateSelection: function(item){
        if (!item.id) { return item.text; }
        return $('<span>'+item.text+'<span class="color" style="background-color: red"></span></span>');

      }

    });
  }]);