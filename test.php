<?php  
  
class MyClass  
{  
    // Class properties and methods go here  
	public $prop1 = "I'm a class property!"; 
	
	// Some magic methods
	public function __construct()  
    {  
        echo 'The class "', __CLASS__, '" was initiated!<br />';  
    }  
    
    // This is useful for class cleanup (closing a database connection, for instance)
    public function __destruct() 
    { 
        echo 'The class "', __CLASS__, '" was destroyed.<br />';  
    }  
    
    public function __toString()  
    {  
        echo "Using the toString method: ";  
        return $this->getProperty();  
    } 
    
	public function setProperty($newval)  
    {  
        $this->prop1 = $newval;  
    }  
  
    public function getProperty()  
    {  
        return $this->prop1 . "<br />";  
    } 
	
}  

class MyOtherClass extends MyClass  
{  
    public function newMethod()  
    {  
        echo "From a new method in " . __CLASS__ . ".<br />";  
    }  
}

// Create a new object  
$newobj = new MyOtherClass;  
  
// Output the object as a string  
echo $newobj->newMethod();  
  
// Use a method from the parent class  
echo $newobj->getProperty();


// Create a new object  
$obj = new MyClass;  
#$obj2 = new MyClass; 

#var_dump($obj);  

#echo $obj->prop1; // Output the property

#echo $obj->getProperty(); // Get the property value  
  
#$obj->setProperty("I'm a new property value!"); // Set a new one  
  
#echo $obj->getProperty(); // Read it out again to show the change 

// Get the value of $prop1 from both objects  
#echo $obj->getProperty();  
#echo $obj2->getProperty(); 

// Set new values for both objects  
#$obj->setProperty("I'm a new property value!");  
#$obj2->setProperty("I belong to the second instance!"); 

// Output both objects' $prop1 value  
#echo $obj->getProperty();  
#echo $obj2->getProperty();   
  
// Get the value of $prop1  
#echo $obj->getProperty(); 

// Output the object as a string  
echo $obj;   

// Destroy the object  
unset($obj);
  
// Output a message at the end of the file  
echo "End of file.<br />";  
  
?>  