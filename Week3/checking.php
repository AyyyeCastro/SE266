<?php
 
 	include ("./account.php");
 
    //CheckingAccount extends the Account class
    class CheckingAccount extends Account 
    {
        const OVERDRAW_LIMIT = -200;

        //Implements the withdrawal method
        public function withdrawal($checkingWithdrawAmount) 
        {
            if (isset($_POST['withdrawChecking'])){
                // get the input value entered ->
                $checkingWithdrawAmount = filter_input (INPUT_POST, 'checkingWithdrawAmount');
                // get the value that is stored in this input variable
                $checkingBalance = filter_input (INPUT_POST, 'checkingBalance');
                // subtract the input value from the balance value. 
                $checkingWithdrawAmount += $checkingBalance;
            }else{
                // if nothing is entered, assume $20. 
                $checkingBalance = 20;
            }
        } // end withdrawal

        public function deposit($checkingDepositAmount){

            // if the deposit checking button is clicked ->
            if (isset($_POST['depositChecking'])){
                // get the input value entered ->
                $checkingDepositAmount = filter_input (INPUT_POST, 'checkingDepositAmount');
                // get the value that is stored in this input variable
                $checkingBalance = filter_input (INPUT_POST, 'checkingBalance');
                // add the input value to the balance value. 
                $checkingDepositAmount += $checkingBalance;
            }else{
                // if nothing is entered, assume $20. 
                $checkingBalance = 20;
            }
        } // end deposit


        //Overrides getAccountDetails by outputting "Checking Account" and then calling getAccountDetails from the Account class:
        public function getAccountDetails() 
        {
            $strAccountDetails = "<h2>Checking Account</h2>";
            $strAccountDetails .= parent::getAccountDetails();
            
            return $strAccountDetails;
        }
        
    } 
?>

