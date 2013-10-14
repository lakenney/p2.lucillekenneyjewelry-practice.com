<?php

class practice_controller extends base_controller {

	public function test1() {
	
	// Make sure code has access to my image class ... temporary solution
	// We can remove this 'require' when we use Auto-loading ... cascading file system
	// Auto-loading checks 3 levels for 'Image' class 
	// first the App then Core then Shared level
	// finds it and automatically loads it ... 
	// i.e., Index calls Bootstrap which calls method 'spl_autoload_register' which
	// references the function in charge of locating 'File' file.php in libraries.
	#require(APP_PATH.'/libraries/Image.php');
	
	#echo "You are looking at test1.";
	
	// Constant to find the root path ... more when we get to cascading file system
	#echo APP_PATH."<br>";
	#echo DOC_ROOT."<br>";
	
	// Once we have access, we instantiate an object from that class
	// and pass it a parameter
	$imageObj = new Image('http://placekitten.com/1000/1000');
	
	// Then we can use the methods in that class
	$imageObj->resize(500,500);
	
	$imageObj->display();
	
	}
	
	// Auto-loading libraries
	public function test2() {
	
	// Static='::' Unix time stamp ... 
	// not creating an object, accessing the methods directly
	echo Time::now();
	
	}
	
	// Our Insert SQL command
	public function test3() {
	
	#$q = "INSERT INTO users SET 
    	#first_name = 'Sam', 
    	#last_name = 'Seaborn',
    	#email = 'seaborn@whitehouse.gov'";

	# Run the command
	#echo DB::instance(DB_NAME)->query($q);	
	
	$data = Array(
    	'first_name' => 'Sam', 
    	'last_name' => 'Seaborn', 
    	'email' => 'seaborn@whitehouse.gov');

	/*
	Insert requires 2 params
	1) The table to insert to
	2) An array of data to enter where key = field name and value = field data

	The insert method returns the id of the row that was created
	*/
	$user_id = DB::instance(DB_NAME)->insert('users', $data);

	echo 'Inserted a new row; resulting id:'.$user_id;
	}

	// Our Update SQL command
	public function test4() {
	$q = "UPDATE users
    	SET email = 'samseaborn@whitehouse.gov'
    	WHERE email = 'seaborn@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}

	// Our Delete SQL command
	public function test5() {
	$q = "DELETE FROM users
    	WHERE email = 'sam@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}
	
	# Prevent SQL injection attacks by sanitizing the data the user entered in the form
	#$	_POST = DB::instance(DB_NAME)->sanitize($_POST);

	#$	q = "SELECT token
    	#FROM users
    	#WHERE email = '".$_POST['email']."'
    	#AND password = '".$_POST['password']."'
    	#";

	#$token = DB::instance(DB_NAME)->select_field($q);
	
}  # eoc


