<!DOCTYPE html>
<html>
<head>
    <script src="includes/js/angular.min.js"></script>
</head>

<body>
    <div ng-app="myApp" ng-controller="myCtrl">
        <input ng-model="name" type="text">
        <br>
        <h1>Hi {{name}}</h1>
    </div>
</body>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http){
    $scope.name = "Neily"
});
</script>
</html> 