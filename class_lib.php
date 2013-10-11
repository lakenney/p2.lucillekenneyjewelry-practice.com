<?php

//object
class person {
	
		//property
		var $name;
		
		public $height;
		
		//only the same class and classes derived from this class can access the property 
		protected $social_insurance;
		
		// only the same class can access this property
		private $pinn_number;
		
		
		//initialize your object's properties 
		function __construct($persons_name) {
		$this->name = $persons_name;
		}
		
		private function get_pinn_number() {
		return $this->$pinn_number;
		}
		
		//method getter and setter names should match property name
		function set_name($new_name) {
		
			$this->name = $new_name;
		}
		
		function get_name() {
		
			return $this->name;
		}
		
}
?>

<?php

// 'extends' is the keyword that enables inheritance 

class employee extends person {

	function __construct($employee_name) {
	
		$this->set_name($employee_name);
			
	}

}

?>