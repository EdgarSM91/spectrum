front.controller("IndexController",["$scope","$location","$timeout","cfpLoadingBar",function($scope,$location,$timeout,cfpLoadingBar){
    $scope.$location = $location;

    /* Count Values*/
    $scope.count ={
        "curses" : 100,
        "clients":10000,
        "professionals":1000,
        "others":1500,
        "from":0,
        "duration":""
    };
    /* Loading Bar */
    $scope.start = function() {
        cfpLoadingBar.start();
        $scope.fakeIntro = true;
    };
    $scope.complete = function () {
        cfpLoadingBar.complete();
    }
    $scope.start();
    $timeout(function() {
        $scope.complete();
        $scope.fakeIntro = false;
    }, 1500);
    /* End Loading Bar */
}]);