<?php
	ob_start(); 
	session_start(); 
?> 

<?php
	$_SESSION['token'] = hash("sha3-512", session_id());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1, initial-scale=1.0">
	<title>Assignment 4</title>

	<!-- Link to the main CSS file -->
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<header class="pg-banner">
		<h1><a href="index.php">Assignment 4</a></h1>
	



