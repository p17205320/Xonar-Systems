<!--loads connection settings-->
<?php
include ("setup.php"); include ("connect.php")
?>
<!--redirects to homepage after 3 seconds-->
<meta http-equiv="Refresh" content="3; url=https://xonar-systems.joshua-s.website/">
<title>Xonar Systems - Home Page</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   
        <?php 
//        Filters data from post, prepares an SQL statement and then posts it to the database
$fullname = filter_input(INPUT_POST, "FullName");
$addressline1 = filter_input(INPUT_POST, "AddressLine1");
$addressline2 = filter_input(INPUT_POST, "AddressLine2");
$city = filter_input(INPUT_POST, "City");
$postcode = filter_input(INPUT_POST, "Postcode");
$cardholdername = filter_input(INPUT_POST, "CardholderName");
$cardnumber = filter_input(INPUT_POST, "CardNumber");
$expirydate = filter_input(INPUT_POST, "ExpiryDate");
$securitycode = filter_input(INPUT_POST, "SecurityCode");
$stmt = $con->prepare("UPDATE `addresses` SET `Full Name`=?, `Address Line 1`=?, `Address Line 2`=?, `City`=?, `Postcode`=?, `Cardholder Name`=?, `Card Number`=?, `Expiry Date`=?, `Security Code`=? WHERE `addresses`.`User_ID`=?");
$stmt->bind_param('ssssssssss', $fullname, $addressline1, $addressline2, $city, $postcode, $cardholdername, $cardnumber, $expirydate, $securitycode, $_SESSION['User_ID']);
$stmt->execute(); 
$stmt->close();


        ?>
    <h1>Details Updated!</h1>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>