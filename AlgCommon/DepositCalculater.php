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
        <?php
        
        include './Contents/Header.php';
include './Contents/Functions.php';

session_start();
if (!isset($_SESSION['checkbox'])) {

    header("Location:Disclaimer.php");
}

if (isset($_POST['submit'])){
     if ($valid) {
        
       
       header("Location:DepositCalculater.php");
       
    }
}
        
  
?>
        
         
        
    
            <form method="POST" action="DepositCalculater.php ">
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
           
            <button type="submit" name="submit" value="Calculate">Calculate</button>
            <button type="reset" value="clear" name="reset">Clear</button>
        </form>
        
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
    
    
       
    
?>    
  </body>
</html>