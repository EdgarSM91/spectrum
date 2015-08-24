front.service("TokenService",["$http","$q",function($http,$q){
    this.token = function(){
        var $defer = $q.defer();
        $http.get("get/token").success(function(data){
            $defer.resolve(data)
        }).error(function(data){
            $defer.reject(data);
        })
         return $defer.promise;
    }
}])