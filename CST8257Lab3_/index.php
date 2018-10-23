<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <?php
        /*$nameError = "";
        $AmountError = "";
        $RateError = "";
        $yearError = "";
        $pcodeError = "";
        $pNumberError = "";
        $eAddressError = "";
        $emailError = "";
        $prefError= "";*/
        $can_post = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';
        $can_phone = '/^([0-9]{3})-[0-9]{3}-[0-9]{4}$/';
        $Is_valid = true;
        $name = $_POST["name"];
        $Amount = $_POST["pAmount"];
        $Rate = $_POST["iRate"];
        $year = $_POST["years"];
        $pCode = $_POST["pCode"];
        $pNumber = $_POST["pNumber"];
        $eAddress = $_POST["eAddress"];
        $contactpref = $_POST["pref"];
        $pref = $_POST["prefchk"];
        $can_name = "/^[a-zA-Z'-]+$/";
        
        if ($_SERVER['REQUEST_METHOD'] == POST) {
            
        function ValidateCode($can_post, $pCode) {
        if (!preg_match($can_post, $pCode)) {
        $pcodeError = "*Invalid Postal Code,Please try again";
        $GLOBALS['Is_valid'] = false;
        return $pcodeError;
        }
        }
        $pcode1 = ValidateCode($can_post, $pCode);
        
        function ValidatePhone($can_phone, $pNumber) {
        if (!preg_match($can_phone, $pNumber)) {
        $pNumberError = "*Invalid Phone number,Please try again";
        $GLOBALS['Is_valid'] = false;
        return $pNumberError;
        }
        }
        $phone = ValidatePhone($can_phone, $pNumber);
        
        
        function ValidateEmail($eAddress) {
        if (!filter_var($eAddress, FILTER_VALIDATE_EMAIL)) {
        $emailError = "*Invalid email ,Please try again";
        $GLOBALS['Is_valid'] = false;
        return $emailError;
        }
        }
        $email2 = ValidateEmail($eAddress, FILTER_VALIDATE_EMAIL);
        
        function ValidatePrincipal($Amount) {
        if (empty($Amount) || $Amount<0|| (!is_numeric($Amount))) {
        $AmountError = "*Amount should be filled and numeric and greater than 0";
        $GLOBALS['Is_valid'] = false;
        return $AmountError;
        }
        }
        $amount = ValidatePrincipal($Amount);
        
        function ValidateRate($Rate) {
        if (empty($Rate) || $Rate < 0 || (!is_numeric($Rate))) {
        $RateError = "*Rate is Required and Rate should be numeric and not negative<br/><br/>";
        $GLOBALS['Is_valid'] = false;
        return $RateError;
        }
        }
        $rate = ValidateRate($Rate);
        
        function ValidateYears($year) {
        if (($year > 20 ) || ($year < 1)) {
        $yearError = "*Number of years to deposit must be a numeric between 1 and 20.<br/><br/>";
        $GLOBALS['Is_valid'] = false;
        return $yearError;
        }
        }
        $yearError = ValidateYears($year);
        
       /* function ValidateName($name) {
        if (empty($name)) {
        $nameError = "*Name is required<br/><br/>";
        $GLOBALS['Is_valid'] = false;
        return $nameError;
        }
        }
        $name1 = ValidateName($name);*/
        function ValidateName($can_name, $name) {
        if (!preg_match($can_name, $name) || empty($name)) {
        $nameError = "*Invalid name,Please try again";
        $GLOBALS['Is_valid'] = false;
        return $nameError;
        }
        }
        $name1 = ValidateName($can_name, $name);
        
        
        function ValidatePref($contactpref,$pref) {
        if ($contactpref == "Phone" && empty($pref)) {
        $prefError = "* When preferred contact method is phone, you have to select contact time";
        $GLOBALS['Is_valid'] = false;
        return $prefError;
        }
    
        }
        $valpref = ValidatePref($contactpref,$pref);
        }
        
    if(($Is_valid) && isset($_POST['submit'])){
?>
        
         <p> 
            Thank you 
            <span class = "distinct">
                <strong><?php echo "$name"; ?></strong>
            </span>
            for using our deposit calculator! <br>
            Our customer service will <?php
        if ($contactpref == "Mail") {
            echo "email you tomorrow at $eAddress";
        } else {
            echo "call you tomorrow ";
            if ($contactpref == "Phone") {
                foreach ($pref as $value) {
                    echo $value;
                    if ($value != end($pref)) {
                        echo ' or ';
                    }
                }
                echo " at $pNumber";
            }
        }
?>
            
            
            <br>
            <br>
            The following is the result of your calculation 
            <span class = "distinct">
                <strong><?php print( "$book "); ?></strong>       
            </span>
            mailing list.
        </p>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Year </th>
                    <th scope="col">Principal at start of year</th>
                    <th scope="col">Interest of the year</th>
                </tr>
<?php
            setlocale(LC_MONETARY, "en_CA");
            for ($i = 1; $i <= $year; $i++) {
            echo "<tr>";
            $r = ($Rate / 100.0) * $Amount;
            $p = $Amount;
            $calc_int = $r;
            echo "<td>" . $i . "</td>";
            echo "<td>" . "$" . number_format($p, 2) . "</td>";
            echo "<td>" . "$" . number_format($calc_int, 2) . "</td>";
            echo "</tr>";
            $Amount = $p + $r;
        }
        echo "</table>"; 
    }
    
       
    else
    {
?>        
        <form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?> ">
            <h2>Deposit Calculator</h2>
            <table>
                <tr>
                    <td>Principal Amount:</td>
                    <td><input type = "text" name = "pAmount" value="<?php echo isset($Amount) ? $Amount : ' '; ?>" /></td>
                    <td><?php echo "<p class='error'>" . $amount . "</p>"; ?></td>
                </tr>
                <tr>
                    <td>Interest Rate(%):</td>
                    <td><input type = "text" name = "iRate" value="<?php echo isset($Rate) ? $Rate : ' '; ?>" /></td>
                    <td><?php echo "<p class='error'>" . $rate . "</p>"; ?><td>
                </tr>
                <tr>
                    <td>Years To Deposit:</td>
                    <td>
                        <select name="years" id="yearlist" style="width: 175px;">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                        </select>
                        <script>
                        document.getElementById('yearlist').value ="<?php echo $year?>"
                        </script>
                    </td>
                    <td><?php echo "<p class='error'>" . $yearError . "</p>"; ?></td>
                </tr>
            </table>
            <br/>
            <hr>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type = "text" name = "name" value="<?php echo isset($name) ? $name : ' '; ?>" /></td>
                    <td><?php echo "<p class='error'>" . $name1 . "</p>"; ?></td>
                </tr>
                <tr>
                    <td>Postal Code:</td>
                    <td><input type = "text" name = "pCode" value="<?php echo isset($pCode) ? $pCode : ' '; ?>" /></td>
                    <td><?php echo "<p class='error'>" . $pcode1 . "</p>"; ?></td>
                </tr>
                <tr>
                    <td>Phone Number:<br/>
                    </td>
                    <td><input type = "text" name = "pNumber" value="<?php echo isset($pNumber) ? $pNumber : ' '; ?>"/></td>
                    <td><?php echo "<p class='error'>" . $phone . "</p>"; ?></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td><input type = "text" name = "eAddress" value="<?php echo isset($eAddress) ? $eAddress : ' '; ?>"/></td>
                    <td><?php echo "<p class='error'>" . $email2 . "</p>"; ?></td>
                </tr>
            </table>
            <br/>
            <hr>
            <p><b>Preferred Contact Method:</b></p>
            <input type = "radio" name = "pref" value = "Phone" value="<?php echo isset($contact) ? $contact : ' '; ?>" checked/>Phone
            <input type = "radio" name = "pref" value = "Mail" />Mail<br/>
           <!--<script>
                $("input:radio").on("change", function()){
                    $("input[type=checkbox]").attr("disabled",!($(this).val() == 'Phone'));
                });
                </script> -->
            <p><b>If phone is selected, when can we contact you?<br/>(check all applicable)</b></p>
            <input type="checkbox" name="prefchk[]" value="morning" />Morning
            <input type="checkbox" name="prefchk[]" value="afternoon" />Afternoon
            <input type="checkbox" name="prefchk[]" value="evening" />Evening
            <?php echo "<p class='error'>" . $valpref . "</p>"; ?>
            <br/><br/>
            <button type="submit" name="submit" value="Calculate">Calculate</button>
            <button type="reset" value="clear" name="reset">Clear</button>
        </form>
<?php 
    }
?>
    </body>
</html>