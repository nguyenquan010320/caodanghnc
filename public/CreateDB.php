	<?php 
// This script will create database base on .env file.

// Get value from .env file ===================================
	$myfile = fopen("../.env", "r") or die("Unable to open file!");
	$text = fread($myfile,filesize("../.env"));

// DB_USERNAME=xxxx 
	$matches = [];
	preg_match_all("/DB\_USERNAME\=(.+?)\n/is", $text, $matches);
	$username = $matches[1][0]; 

// DB_PASSWORD=xxxx
	$matches = [];
	preg_match_all("/DB\_PASSWORD\=(.+?)\n/is", $text, $matches);
	$password = $matches[1][0]; 

// DB_DATABASE=xxxxx 
	$matches = [];
	preg_match_all("/DB\_DATABASE\=(.+?)\n/is", $text, $matches);
	$dbname = $matches[1][0]; 

	fclose($myfile);

// Create DB ==================================================
	$servername = "localhost";
// Create connection
	$conn = new mysqli($servername, $username, $password);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,"utf8mb4");

// Create database
	$conn->query("DROP DATABASE ".$dbname.";");
	$sql = "CREATE DATABASE ".$dbname." CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
	if ($conn->query($sql) === TRUE) {
		echo "Database ".$dbname." created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
	$conn->close();
	sleep(15);
	header('Location: /');
	exit();
	?>