
<?php
include ("setup.php");
?>

<head>
<meta http-equiv="Refresh" content="3; url=<?php echo $_SERVER['HTTP_REFERER'];?>"> 
<title>PC Site - Signout</title>
</head>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   
        <?php
        //wipes all varibles in session varible
session_unset(); 
session_destroy(); 
?>
    <h1> You have been logged out </h1>

        <?php include ("FooterBar.php") ?>
</div>
    
</body>