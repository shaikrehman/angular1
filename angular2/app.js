var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http){
	$scope.user = {};
	$scope.countries = [];
	$scope.users = [];
	
	//country list dropdown
	$http.get("country_list.php")
    	.then(function (response) {
			$scope.countries = response.data;
		});
	
	//User table
	function getUsers(){
		$http.get("users.php")
    	.then(function (response) {
			$scope.users = response.data;
		//	console.log($scope.users);
		});	
	}
	
	//Delete User data
	var user_id;
	$scope.deleteUser =function(thisUser){
		user_id=thisUser.id;
		var data = $.param({
            id: thisUser.id
        });
     	$http({
			method : 'POST',
			url : 'delete_user.php',
			data : data,
			headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response){
			$scope.users = removeElementByAttreibute($scope.users,'id',user_id);
		});

	}

	//submit function
	$scope.addUser = function(){
		$http({
          	method  : 'POST',
          	url     : 'add_user.php',
          	data    : $scope.user, //forms user object
          	headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
        }).success(function(data) {
        	$scope.user = {};
            getUsers();
      	});
	};

	//edit user
	//$scope.eidtedUser = {};
	$scope.editUser = function(thisUser){
		console.log(thisUser);
		$('.add-user').hide();
		$('.update-user').removeClass('hide');
		$scope.user.id = thisUser.id;
		$scope.user.name = thisUser.name;
		$scope.user.email = thisUser.email;
		$scope.user.country = thisUser.country_code;
	}

	$scope.updateUser = function(){
		$http({
          	method  : 'POST',
          	url     : 'update_user.php',
          	data    : $scope.user, //forms user object
          	headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
        }).success(function(data) {
        	console.log(data);
        	$scope.user = {};
            getUsers();
      	});
	}

	$scope.cancel = function(){
		$('.update-user').addClass('hide');
		$('.add-user').removeClass('hide');
		$('.add-user').show();
	}

	function removeElementByAttreibute(users,attr,value){
		var reqNo;
		function getIndex(array, attr, value){
			for(var i=0; i < array.length; i++){
				if(array[i][attr] == value){
			  		reqNo = i;
			  	}
			}
		};
		getIndex(users, attr, value);
		users.splice(reqNo, 1);
		return users;
	}
	getUsers();
});