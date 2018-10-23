<?php
include './Contents/Header.php';
include './Contents/Functions.php';
?>
<?php
session_start();
session_destroy();
?>
<html>
    <head>
        <title>
            
        </title>
        <style>
           
            </style>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <?php
                    
                    if(isset($_SESSION["Name"])){
                        echo "<p><h1> Thank you ". $_SESSION["Name"] ." for using our calculator tool.</h1></p><br>";
                        echo "<p>An email about the details of our GIC has been sent to " . $_SESSION['EmailAddress'] . "</p>";
                    }
                    
                    else{
                        echo "<p><h1> Thank you for using our calculator tool.</h1></p><br>";
                    }
                    
                    ?>
                     
        </tr>
                </tr>
        </tbody>
</table>
    </body>
</html>

<?php
include './Contents/Footer.php';
?>