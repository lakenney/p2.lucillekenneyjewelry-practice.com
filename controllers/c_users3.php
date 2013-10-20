<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
    
        // Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        // Render template
            echo $this->template;
            
        #echo "This is the signup page";
    }
    
    public function p_signup() {

        // Dump out the results of POST to see what the form submitted
        #echo '<pre>'
        #print_r($_POST);
        #echo '</pre>'
        
        // More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	
    	// Encrypt the password  
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

    	// Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 
        
        // Insert this user into the database
    	$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

    	// For now, just confirm they've signed up - 
    	// You should eventually make a proper View for this
    	echo 'You\'re signed up';        
    }

    public function login() {
    
        // Setup view
        	$this->template->content = View::instance('v_users_login');
        	$this->template->title   = "Login";

    	// Render template
        	echo $this->template;
    
        #echo "This is the login page";
    }
    
    public function p_login() {
    
    	echo '<pre>';
		print_r($this->user);
		echo '</pre>';

    	// Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    	$_POST = DB::instance(DB_NAME)->sanitize($_POST);

    	// Hash submitted password so we can compare it against one in the db
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

    	// Search the db for this email and password
    	// Retrieve the token if it's available
    	$q = "SELECT token 
        	FROM users 
        	WHERE email = '".$_POST['email']."' 
        	AND password = '".$_POST['password']."'";

    	$token = DB::instance(DB_NAME)->select_field($q);   

    	// If we didn't get a token back, it means login failed
    	if(!$token) {

        	// Send them back to the login page
        	Router::redirect("/users/login/");

    	// But if we did, login succeeded! 
    	} else {

        	/* 
        	Store this token in a cookie using setcookie()
        	Important Note: *Nothing* else can echo to the page before setcookie is called
        	Not even one single white space.
        	param 1 = name of the cookie
        	param 2 = the value of the cookie
        	param 3 = when to expire
        	param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        	*/
        	setcookie("token", $token, strtotime('+1 year'), '/');

        	// Send them to the main page - or whever you want them to go
        	Router::redirect("/");

    	}

	}

    public function logout() {
        echo "This is the logout page";
    }
	
	// Create a view that's in charge of displaying this information.
    public function profile($user_name = NULL) {
    
    	// An instance of the master template was already created in the base
    	#$template = View::instance('_v_template');
    
    // 	Recreated the Isolated view fragment using the master template _v_template
    	// Pass our view fragment to the content on view page
    	// Set up the View
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile";
    	
    	// Create an array for all the client files
    	// This is a method inside utilities library to help with this
    	$client_files_head = Array(
    		'/css/profile.css', 
    		'/css/master.css'
    		);	

    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
  
  		// Load client files
  		$client_files_body = Array(
    		'/js/profile.js' 
    		);  	

    	$this->template->client_files_body = Utils::load_client_files($client_files_body);

    	
    	// Pass the data to the View
    	$this->template->content->user_name = $user_name;
    	
    	// So we just need to access this template set in the base controller
    	// Display the View
    	echo $this->template;
    
    // Isolated view fragment
    	// Call upon this view file and load it from my controller
    	// instance returns whatever is in v_users_profile
    	#$view = View::instance('v_users_profile');
    	
    	// Then pass data from my controller to the view 
    	// Can pass it parameters on the fly
    	#$view->user_name = $user_name;
    	#$view->color = "red";
    	
    	$this->template->content = View::instance('v_users_profile');
    	// Only when you're done with your code you can echo out view
    	#echo $view;
    }

} # end of the class