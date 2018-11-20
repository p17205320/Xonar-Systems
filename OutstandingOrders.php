
<?php
include ("setup.php"); include ("connect.php")
?>

<title>Xonar Systems - Outstanding Orders</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   <form action="OutstandingOrdersFinalized.php" method="POST" >
        <?php 
        // checks if user is an admin
       if (!isset($_SESSION['Admin'])) {
           //if nto deny access
          echo  "<h1>ACCESS DENIED</h1>";
       } else {
           // if yes get all rows that have the Complete flag as "0" or FALSE
        $stmt = $con->prepare("SELECT * FROM `orders` WHERE Complete = 0");
        $stmt->execute(); 
        $result = $stmt->get_result();
        $stmt->close();
        
        while($row = mysqli_fetch_array($result))
                 
            {    
                $orderid = $row['Order ID'];
                $userid = $row['User ID'];
                $cpu = $row['Product_CPU'];
                 $case = $row['Product_Case'];
                 $motherboard = $row['Product_Motherboard'];
                 $gpu = $row['Product_GPU'];
                 $ram = $row['Product_RAM'];
                 $psu = $row['Product_PSU'];
                 $storage = $row['Product_Storage'];
                 $fullname = $row['Full Name'];
                 $addressline1 = $row['Address Line 1'];
                 $addressline2 = $row['Address Line 2'];
                 $city = $row['City'];
                 $postcode = $row['Postcode'];
                 //display them in a table
                echo <<<END
            <h2 style = "font-family: sans-serif">Order #$orderid</h2>
            <table border="0">
        <tbody style = "font-family: sans-serif">
                 <tr>
                    <td>User ID:</td>
                    <td>$userid</td>
                </tr>
                        <tr>
                    <td>CPU:</td>
                    <td>$cpu</td>
                </tr>
                        <tr>
                    <td>Case:</td>
                    <td>$case</td>
                </tr>
                        <tr>
                    <td>GPU:</td>
                    <td>$gpu</td>
                </tr>
                        <tr>
                    <td>Motherboard:</td>
                    <td>$motherboard</td>
                </tr>
                        <tr>
                    <td>RAM:</td>
                    <td>$ram</td>
                </tr>
                        <tr>
                    <td>PSU:</td>
                    <td>$psu</td>
                </tr>
                        <tr>
                    <td>Storage:</td>
                    <td>$storage</td>
                </tr>
                 <tr >
                    <td align="center" colspan="2" ><h3>Shipping Info</h3></td>
                </tr>
                 <tr>
                    <td>Full Name:</td>
                    <td>$fullname</td>
                </tr>
                 <tr>
                    <td>Address Line 1:</td>
                    <td>$addressline1</td>
                </tr>
                 <tr>
                    <td>Address Line 2:</td>
                    <td>$addressline2</td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td>$city</td>
                </tr>
                <tr>
                    <td>Postcode:</td>
                    <td>$postcode</td>
                </tr>
                        </tbody>
    </table>        <label for="confirmed" style =>Order Complete</label>
                   <input type="checkbox" name="confirmed[]" value="$orderid" /> 

                        <br>
                        <br>
                        
END;
                //the values from the checkboxes are the orderid for that order. when checked it stored them in an array called confirmed and sent via POST
            }
        }
        ?>
       <input type="submit" name="submit" value="Submit" />
                        <br>
                        <br>
                        
                        </form>
       <br>
                        <br>
<?php include ("FooterBar.php") ?>
</div>
    
</body>