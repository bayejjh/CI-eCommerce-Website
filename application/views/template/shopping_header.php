<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shop | Gotta Code 'Em All</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/store_style.css">
</head>
<body>
<div class="content">
	<ul class="shopping_header">
		<li>Dojo eCommerce</li>
		<li><a href="cart">Shopping Cart (
<?php 	if(!empty($cart_num)) {
			echo $cart_num;
		} else {
			echo 'Empty';
		} ?>)</a></li>
	</ul>
