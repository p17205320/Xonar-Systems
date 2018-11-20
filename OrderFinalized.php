<?php
include ("setup.php"); include("connect.php");
?>
<meta http-equiv="Refresh" content="3; url=http://xonar-systems.joshua-s.website/">
<title>Xonar Systems - Order Finalized</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
<!--   retrieves product info from session, put them in local varibles, unsets those session varibles, gets and filters from POST, prepares an SQL statement then posts it to the database-->
 <?php 
$id =  $_SESSION['User_ID'];
$cpu = $_SESSION['CPU'];
$case = $_SESSION['Case'];
$gpu = $_SESSION['GPU'];
$motherboard = $_SESSION['Motherboard'];
$ram = $_SESSION['RAM'];
$psu = $_SESSION['PSU'];
$storage = $_SESSION['Storage'];
$total = $_SESSION['total'];
unset($_SESSION['CPU']);
unset($_SESSION['Case']);
unset($_SESSION['Motherboard']);
unset($_SESSION['RAM']);
unset($_SESSION['PSU']);
unset($_SESSION['Storage']);
unset($_SESSION['GPU']);
unset($_SESSION['total']);
$fullname = filter_input(INPUT_POST, "FullName");
$addressline1 = filter_input(INPUT_POST, "AddressLine1");
$addressline2 = filter_input(INPUT_POST, "AddressLine2");
$city = filter_input(INPUT_POST, "City");
$postcode = filter_input(INPUT_POST, "Postcode");
$cardholdername = filter_input(INPUT_POST, "CardholderName");
$cardnumber = filter_input(INPUT_POST, "CardNumber");
$expirydate = filter_input(INPUT_POST, "ExpiryDate");
$securitycode = filter_input(INPUT_POST, "SecurityCode");
 	$stmt = $con->prepare("INSERT INTO `orders` (`User ID`, `Product_Case`, `Product_CPU`, `Product_Motherboard`, `Product_GPU`, `Product_RAM`, `Product_PSU`, `Product_Storage`, `Price`, `Full Name`, `Address Line 1`, `Address Line 2`, `City`, `Postcode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssssssdsssss', $id, $case, $cpu, $motherboard, $gpu, $ram, $psu, $storage, $total, $fullname, $addressline1, $addressline2, $city, $postcode);
        $stmt->execute(); 
        $stmt->close();
 ?>
    
    <h1>Order Complete!</h1>
    <p>Thanks for shopping with Xonar Systems!</p>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>