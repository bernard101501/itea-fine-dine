<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="<?= base_url('assets/app/lib/angular-1.8.2/angular.min.js') ?>"></script>
	<script src="<?= base_url('assets/app/lib/angular-1.8.2/angular-cookies.min.js') ?>"></script>
	<script src="<?= base_url('assets/app/lib/angular-1.8.2/angular-animate.min.js') ?>"></script>
	<script src="<?= base_url('assets/app/lib/angular-1.8.2/angular-route.min.js') ?>"></script>
	<script src="<?= base_url('assets/app/app.js') ?>"></script>
	<title>Document</title>
</head>
<style>
	input.ng-invalid.ng-touched {
		border: 2px solid red !important;
	}
</style>
<body>
<div class="container">


	<div class="row" ng-controller="BookingController">
		<div class="md-5">
			<img ng-src="<?= base_url('assets/content/img/logo.png')?>" class="img-fluid" alt="" style="width:500px;">
		</div>
		<form name="customerDetail" ng-submit="sendCustomer()" novalidate ng-controller="BookingController">

			<div class="md-7" style="text-align: center;">
				<welcome-text></welcome-text>
				<br>
				<div class="row">
					<div class="md-6">
						<input type="text" ng-model="name" name="name" ng-required="true" style="margin-bottom:10px;" class="form-control" placeholder="Name">
						<div ng-show="customerDetail.name.$touched && customerDetail.name.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid name</small></div>

						<input type="date" ng-model="date" name="date" ng-required="true" style="margin-bottom:10px;" class="form-control">
						<div ng-show="customerDetail.date.$touched && customerDetail.date.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid date</small></div>

						<input type="number" ng-model="adultPax" name="adultPax" min="1" ng-required="true" style="margin-bottom:10px;" class="form-control" placeholder="Adult Pax">
						<div ng-show="customerDetail.adultPax.$touched && customerDetail.adultPax.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid number</small></div>
					</div>
					<div class="md-6">
						<input type="tel" ng-model="mobile" name="mobile" ng-required="true" style="margin-bottom:10px; margin-left: 10px;" ng-pattern="/^[0-9]{9,11}$/" class="form-control" placeholder="Mobile">
						<div ng-show="customerDetail.mobile.$touched && customerDetail.mobile.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid mobile number</small></div>

						<input type="time" ng-model="time" name="time" ng-required="true" style="margin-bottom:10px; margin-left: 10px;" class="form-control">
						<div ng-show="customerDetail.time.$touched && customerDetail.time.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid time</small></div>

						<input type="number" ng-model="kidPax" name="kidPax" min="1" ng-required="true" style="margin-bottom:10px; margin-left: 10px;" class="form-control" placeholder="Kid Pax">
						<div ng-show="customerDetail.kidPax.$touched && customerDetail.kidPax.$invalid"><small style="color: red; display: block; text-align: center;">Enter a valid number</small></div>
					</div>

				</div>
			</div>

			<div class="float-right" >
				<input type="submit" class="btn btn-primary text-white" value="Next" ng-disabled="customerDetail.$invalid">
			</div>
		</form>
	</div>


</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
	var myApp = angular.module('myApp',['ngRoute','ngAnimate','ngCookies']);

	myApp.directive("welcomeText", function() {
		return {
			template : "<br><h3>Welcome to NiceToEat Restaurant</h3><h5>Would you like to make a reservation?</h5>"
		};
	});

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
			window.location.href = ('starter');
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

</script>
</body>
</html>
