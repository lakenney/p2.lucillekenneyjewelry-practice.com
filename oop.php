<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>OOP in PHP</title>

<?php include("class_lib.php"); ?>


</head>

<body>

<?php

	// To create an object out of a class, you need to use the 'new' keyword.
	$stefan = new person("Stefan Mischook");
	
	//$jimmy = new person("Nick Waddles");
	
	
	//$stefan ->set_name("Stefan Mischook");
	
	//$jimmy ->set_name("Nick Waddles");


	echo "Stefan's full name: " . $stefan->get_name();
	
	//echo "Nick's full name: " . $jimmy->get_name();


	/*
	Since $pinn_number was declared private, this line of code 
	will generate an error. Try it out!
	*/

	//echo "Tell me private stuff: " . $stefan->$pinn_number;

	// we can call get_name on our 'employee' object, courtesy of 'person'
	$james = new employee("Johnny Fingers");
	echo "---> " . $james->get_name();

?>

</body>

</html>