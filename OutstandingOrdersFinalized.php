<?php
include ("setup.php"); include ("connect.php")
?>
<meta http-equiv="Refresh" content="3; url=<?php echo $_SERVER['HTTP_REFERER'];?>"> 
<title>Xonar Systems - Home Page</title>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   <?php
   // goes through all values in array and sets them as complete
   foreach($_POST['confirmed'] as $selected){
   $stmt = $con->prepare( "UPDATE `orders` SET `Complete` = '1' WHERE `orders`.`Order ID` = ?");
   $stmt->bind_param('i', $selected);
   $stmt->execute(); 
   $stmt->close();

   }


?>
       <h1>Database Updated</h1>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>