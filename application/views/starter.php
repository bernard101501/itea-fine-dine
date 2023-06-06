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
<div class="container" ng-controller="StarterController">



		<br>
		<div class="row">
			<div class="col-md-5">
				<b>Starter</b>
			</div>
			<div class="col-md-7 text-right">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cart">Cart ({{countFood}})</button>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Your Cart - Starter</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table">
							<tr>
								<th colspan="2">Item Selected</th>
								<th>Total</th>
								<!-- <th></th> -->
							</tr>
							<tr ng-repeat="cartFood in starter">
								<td>{{ cartFood.number }} .</td>
								<td>{{ cartFood.name }} x {{ cartFood.quantity }}</td>
								<td>{{ cartFood.total | currency:'RM' }}</td>
								<!-- <td><button type="button" class="close" style="color: rgb(156, 20, 20);" ng-click="remove(cartFood)"><span aria-hidden="true">&times;</span></button></td> -->
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" ng-click="removeAll()" data-dissmiss="modal">Remove All</button>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			Choose your starters
		</div>
		<div class="row">
			<div class="card text-center md-4" style="width: 18rem; margin-left: 50px; margin-top: 50px;" ng-repeat="starter in starterFood">
				<div class="card-body">
					<img ng-src="assets/{{starter.image}}" alt="" class="img-fluid" style="height: 10rem;">
					<div>{{starter.name}}</div>
					<div>{{starter.price | currency:'RM' }}</div>
					<br>
					<button type="button" class="btn btn-primary" ng-click="addToCart(starter)">Add To Cart</button>
				</div>
			</div>
		</div>
		<br>
		<div class="float-right" >
			<div class="row">
				<a href="<?= base_url('booking') ?>" class="btn btn-primary text-white" >Previous</a>
				<a href="#!/mainFood" class="btn btn-primary text-white" style="margin-left:10px;">Next</a>
			</div>
		</div>



</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
	var myApp = angular.module('myApp',['ngRoute','ngAnimate','ngCookies']);

	myApp.controller('StarterController',['$scope','$http','$cookies',function($scope,$http,$cookies){

		$http.get('assets/data/starterFood.json').then(function(response){
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



</script>
</body>
</html>
