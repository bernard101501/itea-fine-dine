var myApp = angular.module('myApp',['ngRoute','ngAnimate','ngCookies']);


myApp.config(['$routeProvider','$cookiesProvider',function ($routeProvider,$cookiesProvider){

    $cookiesProvider.defaults.path = '/'; // Set the default cookie path

    $routeProvider
        .when('/home',{
            templateUrl: 'views/main.html',
        })
        .when('/booking',{
            templateUrl: 'views/customer_detail.html',
            controller: 'BookingController'
        })
        .when('/starter',{
            templateUrl: 'views/starter.html',
            controller: 'StarterController'
        }).when('/mainFood',{
          templateUrl: 'views/main_food.html',
          controller: 'MainFoodController'
        }).when('/checkout',{
          templateUrl: 'views/checkout.html',
          controller: 'CheckoutController'

        }).otherwise({
        redirectTo: '/home'
    })

}]);




myApp.controller('BookingController', ['$scope', '$cookies', '$location','$filter', function($scope, $cookies, $location,$filter) {

    $scope.sendCustomer = function() {
      var name = $scope.name;
      var mobile = $scope.mobile;
      var date = $scope.date;
      var time = $scope.time;
      var adultPax = $scope.adultPax;
      var kidPax = $scope.kidPax;
  
      $cookies.put('name', name);
      $cookies.put('mobile', mobile);
      $cookies.put('date', date);
      $cookies.put('time', time);
      $cookies.put('adultPax', adultPax);
      $cookies.put('kidPax', kidPax);

  
      // console.log(time);
      // Redirect to '/starter' page
      $location.path('/starter');
    };

    var currentName = $cookies.get('name');
    if(currentName != null){
      $scope.name = currentName;
    }

    var currentMobile = $cookies.get('mobile');
    if(currentMobile != null){
      $scope.mobile = currentMobile;
    }

    var currentDate = $cookies.get('date');
    if(currentDate != null){
      $scope.date = new Date(currentDate);
    }

    var currentTime = $cookies.get('time');
    if(currentTime != null){
      var date = new Date(currentTime);
      $scope.time = date;
    }

    var currentAdultPax = $cookies.get('adultPax');
    if(currentAdultPax != null){
      $scope.adultPax = parseInt(currentAdultPax);
    }

    var currentKidPax = $cookies.get('kidPax');
    if(currentKidPax != null){
      $scope.kidPax = parseInt(currentKidPax) ;
    }

  }]);
  

  myApp.controller('StarterController',['$scope','$http','$cookies',function($scope,$http,$cookies){

    $http.get('data/starterFood.json').then(function(response){
        $scope.starterFood = response.data;
    });


    var starter = [];
    // $cookies.remove('starterFood');
    var currentStartFood = $cookies.get('starterFood');
    if(currentStartFood){
      starter = JSON.parse(currentStartFood);
      $scope.starter = starter
    }else{
      $scope.starter = [];
    }

    // $cookies.remove('countFood');
    var totalCount = 0;
    var currentCountFood = $cookies.get('countFood');
    if(currentCountFood){
      $scope.countFood = currentCountFood;
      totalCount = parseInt(currentCountFood);
    }else{
      $scope.countFood = 0;
    }

    var totalStarterPrice = 0;
    var currentTotalStarterPrice = $cookies.get('totalStarterPrice');
    if(currentTotalStarterPrice){
      totalStarterPrice = parseFloat(currentTotalStarterPrice);
    }else{
      totalStarterPrice = 0;
    }


    var number = starter.length;
    $scope.addToCart = function($food){
      // Check if the food is already in the array
      var existingItem = starter.find(item => item.code == $food.code);
    
      // If it exists, increment the quantity
      if (existingItem) {
        existingItem.quantity += 1;
        existingItem.total = existingItem.quantity*existingItem.price;
        // var total = $food.quantity*$food.price
        totalStarterPrice += $food.price;
        totalCount += 1;

      } else {
        // If it doesn't exist, add it to the array with a quantity of 1
        number += 1;
        $food.number = number;
        $food.quantity = 1;
        $food.total = $food.quantity*$food.price;
        // var total = $food.quantity*$food.price
        totalStarterPrice += $food.price;
        starter.push($food);
        totalCount += 1;

      }

      console.log($food);

    $scope.countFood = totalCount;
    $scope.starter = starter;
    $cookies.put('starterFood', JSON.stringify(starter));
    $cookies.put('countFood', totalCount);
    $cookies.put('totalStarterPrice', totalStarterPrice);
      
    };
    
    $scope.removeAll = function(){
      $cookies.remove('starterFood');
      $cookies.remove('countFood');
      $cookies.remove('totalStarterPrice');
      $scope.starter = [];
      $scope.countFood = 0;
      starter = [];
      totalCount = 0;
      number = 0;
    }

    console.log(totalStarterPrice);

}]);



myApp.controller('MainFoodController',['$scope','$http','$cookies',function($scope,$http,$cookies){

  $http.get('data/mainFood.json').then(function(response){
      $scope.mainFood = response.data;
  });


  var main = [];
  // $cookies.remove('mainFood');
  var currentMainFood = $cookies.get('mainFood');
  if(currentMainFood){
    main = JSON.parse(currentMainFood);
    $scope.main = main;
  }else{
    $scope.main = [];
  }

  // $cookies.remove('countMainFood');
  var totalCount = 0;
  var currentCountFood = $cookies.get('countMainFood');
  if(currentCountFood){
    $scope.countFood = currentCountFood;
    totalCount = parseInt(currentCountFood);
  }else{
    $scope.countFood = 0;
  }


  var totalMainPrice = 0;
    var currentTotalMainPrice = $cookies.get('totalMainPrice');
    if(currentTotalMainPrice){
      totalMainPrice = parseFloat(currentTotalMainPrice);
    }else{
      totalMainPrice = 0;
    }

  var number = main.length;
  $scope.addToCart = function($food){
    // Check if the food is already in the array
    var existingItem = main.find(item => item.code == $food.code);
  
    // If it exists, increment the quantity
    if (existingItem) {
      existingItem.quantity += 1;
      existingItem.total = existingItem.quantity*existingItem.price;
      totalMainPrice += $food.price;
      totalCount += 1;

    } else {
      // If it doesn't exist, add it to the array with a quantity of 1
      number += 1;
      $food.number = number;
      $food.quantity = 1;
      $food.total = $food.quantity*$food.price;
      totalMainPrice += $food.price;
      main.push($food);
      totalCount += 1;

    }

    console.log($food);

  $scope.countFood = totalCount;
  $scope.main = main;
  $cookies.put('mainFood', JSON.stringify(main));
  $cookies.put('countMainFood', totalCount);
  $cookies.put('totalMainPrice', totalMainPrice);
    
  };
  
  $scope.removeAll = function(){
    $cookies.remove('mainFood');
    $cookies.remove('countMainFood');
    $cookies.remove('totalMainPrice');
    $scope.main = [];
    $scope.countFood = 0;
    main = [];
    totalCount = 0;
    number = 0;
  }

  console.log(totalMainPrice);

}]);



myApp.controller('CheckoutController',['$scope','$cookies',function($scope,$cookies){
  var currentName = $cookies.get('name');
  if(currentName != null){
    $scope.name = currentName;
  }

  var currentMobile = $cookies.get('mobile');
  if(currentMobile != null){
    $scope.mobile = currentMobile;
  }

  var currentDate = $cookies.get('date');
  if(currentDate != null){
    $scope.date = new Date(currentDate);
  }

  var currentTime = $cookies.get('time');
  if(currentTime != null){
    var date = new Date(currentTime);
    $scope.time = date;
  }

  var currentAdultPax = $cookies.get('adultPax');
  if(currentAdultPax != null){
    $scope.adultPax = parseInt(currentAdultPax);
  }

  var currentKidPax = $cookies.get('kidPax');
  if(currentKidPax != null){
    $scope.kidPax = parseInt(currentKidPax) ;
  }

  var currentMainFood = $cookies.get('mainFood');
  if(currentMainFood){
    main = JSON.parse(currentMainFood);
    $scope.main = main;
  }else{
    $scope.main = [];
  }

  var currentStartFood = $cookies.get('starterFood');
    if(currentStartFood){
      starter = JSON.parse(currentStartFood);
      $scope.starter = starter
    }else{
      $scope.starter = [];
    }


    var totalMainPrice = 0;
    var currentTotalMainPrice = $cookies.get('totalMainPrice');
    if(currentTotalMainPrice){
      totalMainPrice = parseFloat(currentTotalMainPrice);
    }else{
      totalMainPrice = 0;
    }


    var totalStarterPrice = 0;
    var currentTotalStarterPrice = $cookies.get('totalStarterPrice');
    if(currentTotalStarterPrice){
      totalStarterPrice = parseFloat(currentTotalStarterPrice);
    }else{
      totalStarterPrice = 0;
    }

    $scope.total = totalMainPrice + totalStarterPrice ;




  console.log(currentName);
}]);
  
  


myApp.directive("welcomeText", function() {
    return {
      template : "<br><h3>Welcome to NiceToEat Restaurant</h3><h5>Would you like to make a reservation?</h5>"
    };
  });
