<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>

    <body>
        <title>Deposit Calculator</title>
        <?php
        $Amount = $_POST["pAmount"];
        $Rate = $_POST["iRate"];
        $name = $_POST["name"];
        $year = $_POST["years"];
        $pCode = $_POST["pCode"];
        $pNumber = $_POST["pNumber"];
        $eAddress = $_POST["eAddress"];
        $contactpref = $_POST["contact"];
        $pref = $_POST["contactTime"];


        $nameError = "";
        $AmountError = "";
        $iRateError = "";
        $yearError = "";
        $pcodeError = "";
        $pNumberError = "";
        $eAddressError = "";



#when you click the submit button after everthing will work
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $cont = TRUE;
           
            if (empty($name)) {
                 echo 'However we can not process your request because of following input errors.<br/><br/><br/>';
                echo ($nameError = "*Name is required<br/><br/>");
                $cont = FALSE;
            }
            
            
            if (empty($Amount > 0) || (!is_numeric($Amount))) {
                echo ($AmountError = "*Amount is required and Amount should be numeric and greater than 0<br/><br/>");
                $cont = FALSE;
            }

            

            if (empty($Rate > 0) || (!is_numeric($Rate))) {

                echo ($AmountError = "*Rate is Required and Rate should be numeric and not negative<br/><br/>");
                $cont = FALSE;
            }


            if (($year > 20 ) || ($year < 1)) {
                echo ($yearError = "*Number of years to deposit must be a numeric between 1 and 20.<br/><br/>");
                $cont = FALSE;
            }

            if (empty($pCode)) {
                echo ($pCodeError = "*Postal Code is required<br/><br/>");
                $cont = FALSE;
            }

            if (empty($pNumber)) {
                echo ($pNumberError = "*Phone Number is required<br/><br/>");
                $cont = FALSE;
            }

            if (empty($eAddress)) {
                echo ($eAddressError = "*Email Address is required<br/><br/>");
                $cont = FALSE;
            }
            
            if (empty($contactpref =="pNumber")&(empty($pref))) {
                echo ($pNumber = "* Choose preferred time");
                $cont = FALSE;
            }

            if (!$cont) {
                exit();
            }
        }
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
# way to add the values in the table
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
?>  
        </table>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html


