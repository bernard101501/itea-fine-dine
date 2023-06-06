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
	<title>Document</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="md-5">
			<img ng-src="<?= base_url('assets/content/img/logo.png')?>" class="img-fluid" alt="" style="width:500px;">
		</div>
		<div class="md-7">
			<welcome-text></welcome-text>
			<br>
			<a href="<?= base_url('booking') ?>" type="button" class="btn btn-primary" style="color: white;">Yes</a>
		</div>
	</div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/app/app.js') ?>"></script>
<script>
	var myApp = angular.module('myApp',['ngRoute','ngAnimate','ngCookies']);

	myApp.directive("welcomeText", function() {
		return {
			template : "<br><h3>Welcome to NiceToEat Restaurant</h3><h5>Would you like to make a reservation?</h5>"
		};
	});
</script>
</body>
</html>
