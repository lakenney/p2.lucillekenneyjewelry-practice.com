<?php

// 'extends' is the keyword that enables inheritance 

class employee_controller extends person {

	function __construct($employee_name) {
	
		$this->set_name($employee_name);
			
	}

}

?>