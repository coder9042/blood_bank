var dataApp = angular.module('dataApp', [])
 
dataApp.factory('dataFactory', function($http) {
  return {
    getdataAsync: function(callback) {
      $http.get('static/data.json').success(callback);
    }
  };
});
 
dataApp.controller('dataController', function($scope, dataFactory) {
  dataFactory.getdataAsync(function(results) {
    console.log('dataController async returned value');
    $scope.vals = results.vals;
  });
});