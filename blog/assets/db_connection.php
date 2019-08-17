<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="blog_test";


	 $connection = mysqli_connect($dbhost , $dbuser , $dbpass , $dbname);
global $connection;
	
	
	if (mysqli_connect_errno()){
		die ("Database connection failed: " . mysqli_connect_error() .
			"(" . mysqli_connect_errno() . ")" );
		
	}
?>