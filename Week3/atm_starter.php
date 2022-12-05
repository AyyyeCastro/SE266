
<?php
    // withdraw button click ->
    if (isset ($_POST['withdrawChecking'])) 
    {
        // property = the value the user input.
        $withdrawAmnt = $_POST['userWithdrawValue'];

        echo "User withdrew: $".$withdrawAmnt." from checking account.";
    } 

    else if (isset ($_POST['depositChecking'])) 
    {
        $depositAmnt = $_POST['userDespositValue'];
        
        // ensure values are gathered and stored correctly.
        echo "User deposited: $".$depositAmnt." to checking account.";
    } 

    else if (isset ($_POST['withdrawSavings'])) 
    {
        $savingsWithdrawAmnt = $_POST['userSavingsWithdrawAmnt'];

        echo "User withdrew: $".$savingsWithdrawAmnt." from savings account.";
    } 

    else if (isset ($_POST['depositSavings'])) 
    {
        $savingsDepositAmnt = $_POST['userSavingsDepositAmnt'];

        echo "User deposited: $".$savingsDepositAmnt." to savings account.";
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ATM</title>
<style type="text/css">
    body {
        margin-left: 120px;
        margin-top: 50px;
    }
   .wrapper {
        display: grid;
        grid-template-columns: 300px 300px;
    }
    .account {
        border: 1px solid black;
        padding: 10px;
    }
    .label {
        text-align: right;
        padding-right: 10px;
        margin-bottom: 5px;
    }
    label {
       font-weight: bold;
    }
    input[type=text] {width: 80px;}
    .error {color: red;}
    .accountInner {
        margin-left:10px;margin-top:10px;
    }
</style>
</head>
<body>

<form method="post"> 
<h1>ATM</h1>
    <div class="wrapper">
        

        <div class="account">
                <input type="hidden" name="checkingAccountId" value="C123" />
                <input type="hidden" name="checkingDate" value="12-20-2019" />
                <input type="hidden" name="checkingBalance" value="<?= $checkingBalance ?>" />
            
                <div class="accountInner">
                    <input type="number" name="userWithdrawValue" value="" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="number" name="userDespositValue" value="" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
        </div>

        <div class="account">
                <input type="hidden" name="savingsAccountId" value="S123" />
                <input type="hidden" name="savingsDate" value="03-20-2020" />
                <input type="hidden" name="savingsBalance" value="5000" />
            
                <div class="accountInner">
                    <input type="number" name="userSavingsWithdrawAmnt" value="" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="number" name="userSavingsDepositAmnt" value="" />
                    <input type="submit" name="depositSavings" value="Deposit" /><br />
                </div>    
        </div> 


    </div><!-- end wrapper -->
</form>
</body>
</html>
