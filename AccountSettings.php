<!--loads connection settings-->
<?php
include ("setup.php"); include("connect.php")
?>

<title>Xonar Systems - Account Settings</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   <?php
//   if the user is logged in
if ($_SESSION['LoggedIn'] == "Yes") {
//                Get all information for that user from database and store it in varibles
                 $stmt = $con->prepare("SELECT * FROM `addresses` WHERE User_ID = (?)");
                    $stmt->bind_param('s', $_SESSION['User_ID']);
                    $stmt->execute(); 
                    $result = $stmt->get_result();
                    $stmt->close();
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
                
         // creates and populates a form with the information. when button is clicked send form info to AccountSettingsFinalized
echo <<<END
            
        </tbody>
    </table>
<h1 style = "text-align: center;">Personal Details</h1>
    <form action="AccountSettingsFinalized.php" method="POST">        
        <table style="text-align: left" border="0">
            <tbody style ="font-family: sans-serif;">
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
                    <td><input type="text" data-inputmask="'mask': '9999-9999-9999-9999'" name="CardNumber" value="$cardnumber" required /></td>
                </tr>
                <tr>
                    <td>Expiry Date:</td>
                    <td><input type="text" data-inputmask="'mask': '99/9999'" name="ExpiryDate" value="$expirydate" required /></td>
                </tr>
                <tr>
                    <td>Security Code:</td>
                    <td><input type="text" data-inputmask="'mask': '999'" name="SecurityCode" size="3" value="$securitycode" required /></td>
                </tr>
            </tbody>
        </table>
            <input type="submit" value="Update Details" />   
        </form>
        <h1 style: "color: red">THIS WEBSITE IS NON-FUNCTIONAL. DO NOT USE REAL PERSONAL DETAILS</h1>
END;

} else {
//    if not logged in show error
    echo "<h1>You need to be logged in to do that</h1>";
}
?>
   
<script type="text/javascript">
    $(":input").inputmask();
    </script>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>