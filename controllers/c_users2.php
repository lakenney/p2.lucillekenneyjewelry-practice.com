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
        echo "This is the signup page";
    }

    public function login() {
        echo "This is the login page";
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
    	$content = View::instance('v_users_profile');
    	$content ->user_name = $user_name;
    	$this->template->content = $content;
    	
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

        #if($user_name == NULL) {
        #	echo "No user specified";
        #}
        #else {
        #	echo "This is the profile for ".$user_name;
        #}
    }

} # end of the class