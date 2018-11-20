<!--loads connection settings-->
<?php
include ("setup.php"); include ("connect.php")
?>

<title>Xonar Systems - Checkout</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
<!--    table for displaying information on the system-->
    <h1 style = "text-align: center;">Order Summary</h1>
    <div id = checkout>
    <table border="1">
        <thead>
            <tr>
                <th>Item</th>
                <th></th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
<!--            takes the product ID that was sent via POST, looks them up in the respective database, retrieves the names and prices, displays the names and prices in a table and then totals the prices and displays that in a table-->
            <?php 
            
            $total = 0;
            $cpu = filter_input(INPUT_POST, "CPU");
            $case = filter_input(INPUT_POST, "Case");
            $gpu = filter_input(INPUT_POST, "GPU");
            $motherboard = filter_input(INPUT_POST, "Motherboard");
            $ram = filter_input(INPUT_POST, "RAM");
            $psu = filter_input(INPUT_POST, "PSU");
            $storage = filter_input(INPUT_POST, "Storage");

            
            for( $i = 0; $i<7; $i++ ) {
                
                if ($i == 0) {
                $fill = "CPU";
               	$stmt = $con->prepare("SELECT * FROM `product cpu` WHERE Product_ID = (?)");
                $stmt->bind_param('s', $cpu);
                } elseif ( $i == 1 ) {
                    $fill = "GPU";
                    $stmt = $con->prepare("SELECT * FROM `product gpu` WHERE Product_ID = (?)");
                    $stmt->bind_param('s', $gpu);
                } elseif ( $i == 2 ) {
                    $fill = "Motherboard";
                    $stmt = $con->prepare("SELECT * FROM `product motherboard` WHERE Product_ID = (?)");
                $stmt->bind_param('s', $motherboard);
                } elseif ( $i == 3 ) {
                    $fill = "RAM";
                    $stmt = $con->prepare("SELECT * FROM `product ram` WHERE Product_ID = (?)");
                    $stmt->bind_param('s', $ram);
                } elseif ( $i == 4 ) {
                $fill = "Case";
                $stmt = $con->prepare("SELECT * FROM `product case` WHERE Product_ID = (?)");
                $stmt->bind_param('s', $case);
                }elseif ( $i == 5 ) {
                    $fill = "PSU";
                    $stmt = $con->prepare("SELECT * FROM `product psu` WHERE Product_ID = (?)");
                    $stmt->bind_param('s', $psu);
                }elseif ( $i == 6 ) {
                    $fill = "Storage";
                    $stmt = $con->prepare("SELECT * FROM `product storage` WHERE Product_ID = (?)");
                    $stmt->bind_param('s', $storage);
                }
                
                $stmt->execute(); 
                $result = $stmt->get_result();
                while($row = mysqli_fetch_array($result))
            {   
                    
                    $total = $total + $row[Price];
                    $name = $row[Name];
                    $price = $row[Price];
                    $_SESSION[$fill] = $name;
                
                echo <<<END
                <tr>
                    <td>$fill:</td>
                    <td>$name</td>
                    <td>£$price</td>
                </tr>
END;
//                Take the total and make it a an appropriate format
                                    $total = number_format($total, 2, '.', ''); 
            }
            }
                echo <<<END
            <tr>
                    <td></td>
                    <td></td>
                </tr>
                    <tr>
                    <td>Total Cost:</td>
                    <td></td>
                    <td>£$total</td>
                </tr>
END;
                // adds total to session for later
           $_SESSION['total'] = $total;
            // retreives user address info if they are logged in and populates the personal details form
                if ($_SESSION['LoggedIn'] == "Yes") {
                
                 $stmt = $con->prepare("SELECT * FROM `addresses` WHERE User_ID = (?)");
                    $stmt->bind_param('s', $_SESSION['User_ID']);
                    $stmt->execute(); 
                    $result = $stmt->get_result();
                     while($row = mysqli_fetch_array($result))
                    {   
                    $fullname = $row['Full Name'];
                    $addressline1 = $row['Address Line 1'];
                    $addressline2 = $row['Address Line 2'];
                    $city = $row['City'];
                    $postcode = $row['Postcode'];
                    $cardholdername = $row['Cardholder Name'];
                    $cardnumber = $row['Card Number'];
                    $expirydate = $row['Expiry Date'];
                    $securitycode = $row['Security Code'];
                     }
                }
            
echo <<<END
            
        </tbody>
    </table>
<h1 style = "text-align: center;">Personal Details</h1>
    <form action="OrderFinalized.php" method="POST">        
        <table style="text-align: left" border="0">
            <tbody>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="FullName" value="$fullname" required /></td>
                </tr>
                <tr>
                    <td>Address line 1:</td>
                    <td><input type="text" name="AddressLine1" value="$addressline1" required /></td>
                </tr>
                <tr>
                    <td>Address line 2:</td>
                    <td><input type="text" name="AddressLine2" value="$addressline2"  /></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td><input type="text" name="City" value="$city" required /></td>
                </tr>
                <tr>
                    <td>Postcode:</td>
                    <td><input type="text" data-inputmask="'mask': 'AA9[9] 9AA'" name="Postcode" value="$postcode" required /></td>
                </tr>
                <tr>
                    <td>Cardholder Name:</td>
                    <td><input type="text" name="CardholderName" value="$cardholdername" required /></td>
                </tr>
                <tr>
                    <td>Card Number:</td>
                    <td><input type="text"  data-inputmask="'mask': '9999-9999-9999-9999'" placeholder="1234-1234-1234-1234" name="CardNumber" value="$cardnumber" required /></td>
                </tr>
                <tr>
                    <td>Expiry Date:</td>
                    <td><input type="text" name="ExpiryDate" data-inputmask="'mask': '99/9999'" placeholder="MM/YYYY"  value="$expirydate" required /></td>
                </tr>
                <tr>
                    <td>Security Code:</td>
                    <td><input type="text" name="SecurityCode" data-inputmask="'mask': '999'"  value="$securitycode" required /></td>
                </tr>
        <tr>
            <td colspan = "2">                    <input style ="font-size: xx-large;
    font-family: BebasNeue;
    width: 100%; margin: 0px" type="submit" value="Confirm Order" /> </td>
        </tr>
            </tbody>
        
        <h1 style: "color: red">THIS WEBSITE IS NON-FUNCTIONAL. DO NOT USE REAL PERSONAL DETAILS</h1>

END;
?>
<script type="text/javascript">
    $(":input").inputmask();
    </script>
        </table>

    </form>

        </div>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>

