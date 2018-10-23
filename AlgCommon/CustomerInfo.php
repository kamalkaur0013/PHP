<?php
include './Contents/Header.php';
include './Contents/Functions.php';

session_start();
if (!isset($_SESSION['checkbox'])) {

    header("Location:Disclaimer.php");
}

if (isset($_POST['submit'])) {


    if ($Is_valid) {

        $_SESSION['Name'] = $_POST['name'];
        $_SESSION['PostalCode'] = $_POST['pCode'];
        $_SESSION['PhoneNumber'] = $_POST['pNumber'];
        $_SESSION['EmailAddress'] = $_POST['eAddress'];




        $_SESSION['Calculator'] = TRUE;

        header("Location:DepositCalculater.php");
    }
}



?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <form method="POST" action="CustomerInfo.php">
            <h2>Customer Information</h2>

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
            <input type = "radio" name = "pref" value = "Phone" checked="checked"<?php echo isset($contact) ? $contact : ' '; ?>"/>Phone
            <input type = "radio" name = "pref" value = "email" />Mail


            <p><b>If phone is selected, when can we contact you?<br/>(check all applicable)</b></p>
            <input type="checkbox" name="prefchk[]" value="morning" />Morning
            <input type="checkbox" name="prefchk[]" value="afternoon" />Afternoon
            <input type="checkbox" name="prefchk[]" value="evening" />Evening
<?php echo "<p class='error'>" . $valpref . "</p>"; ?>

            <br/><br/>
            <button type="submit" name="submit" value="Calculate">Calculate</button>
            <button type="reset" value="clear" name="reset">Clear</button>
        </form>

    </body>
</html>
<?php include'./Contents/Footer.php'; ?>
