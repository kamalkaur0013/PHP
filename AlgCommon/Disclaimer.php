

<?php include'./Contents/Header.php';
include './Contents/Functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    checkbox();
    if($valid){
        session_start();
        $_SESSION['checkbox'] = $_POST['checkbox'];
        header("Location:CustomerInfo.php");
        exit();
    }
    
    
}

?>
<html>
   <head>
       <title>
           Disclaimer
       </title>
       <style>
           .table th,
           .table tr,#error, th #error, tr #error{
               color: red;
           }
       </style>
   </head>
   <body>
       <h2>Terms and Condition</h2>
       <form method="post">
           <table style="border-width: 1px;">
               <tbody>
                   <tr>
                       I agree to abide by the Bank's Terms and condition and rules in force and the changes in Terms and Conditions from time to time relating to my account as communicated and made available  on the Bank's website.<br>
                   </tr>
                   <tr>
                   <br>
                       I agree that bank before opening any deposit account, will carry out a due diligence as required under know your customer guidelines of the bank. I would be required to submit necessary or proofs, such as identity, address, photograph and any such information, i agree to submit the above documents again at periodic intervals, as may be required by the Bank.
                   </tr>
                   <tr>
                   <br>
                   <br>
                       I agree that the Bank can at its sole discretion, amend any of the services/facilities given in my account either wholly or partially at any time by giving me at least 30 days notice and/or provide and option to me to switch to other services/facilities.
                   </tr>
                   <tr>
                       <br><br>
                       <p style="color:red"> <?php echo $errorCheckbox ?> </p>

                       <input  type="checkbox" name="checkbox" value="checked"/>I have read and agree with terms and conditions.<br>
                   </tr>
                   <tr>
                       <input type="submit" name ="submit"  value ="Start" style="position: absolute; top: 515px; left: 650px;"/>
                   </tr>
               </tbody>
           </table>
       </form>
   </body>
</html>
<?php include'./Contents/Footer.php'; ?>