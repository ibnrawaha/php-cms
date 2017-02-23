<?php

$conn = mysqli_connect("localhost","root","","cms");

if (!$conn ) {
	die("Failed to connect to my sql " . mysqli_connect_error() . " :: " . mysqli_connect_errno());
}

// Getting menu data
	$query = "SELECT * FROM menu;";
	$get_menu = mysqli_query($conn, $query);
	if (!$get_menu){
		echo mysqli_error($conn);
	}

// Getting pages data
	$query = "SELECT * FROM pages;";
	$get_pages = mysqli_query($conn, $query);
	if (!$get_pages){
		echo mysqli_error($conn);
	}
	
	
		

?> 
