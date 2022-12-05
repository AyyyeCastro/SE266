<?php
	// This is the base class for checking and savings accounts
	// It is declared **abstract** so that it can not be instantiated
	// Child classes must be derived that 
	// implement the withdrawal and getAccountDetails methods
	
	/* Note:
		You should implement all other methods in the class
	*/
	
    abstract class Account 
    {
        // protected properties
        protected $accountId;
        protected $balance;
        protected $startDate;
        
        
        public function __construct ($id, $bal, $startDt) 
        {
            //initialize properties
            $id="";
            $bal="";
            $startDt="";
        } // end constructor
        
        public function deposit($amount) 
        {
            
        } // end deposit

        abstract public function withdrawal($amount);
        // This is an abstract method. 
        // This method must be defined in all classes
        // that inherit from this class
        
        public function getStartDate() 
        {
            // write code here
        } // end getStartDate

        public function getBalance() 
        {
            // write code here
        } // end getBalance

        public function getAccountId() 
        {
            // write code here
        } // end getAccountId

        // Display AccountID, Balance and StartDate in a nice format
        protected function getAccountDetails()
        {
            // write code here
        } // end getAccountDetails
        
    } // end account

?>


