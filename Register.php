<?php
include ("setup.php");
?>
<head>
<meta http-equiv="Refresh" content="3; url=<?php echo $_SERVER['HTTP_REFERER'];?>"> 
<title>Xonar Systems - Register</title>
</head>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   
<?php
include("connect.php");
//Filtering is done on the input from the session for protection
//sets username and password to varibles, prepares statement and then posts the database
                $username = filter_input(INPUT_POST, "register_username");
                $password = filter_input(INPUT_POST, "register_password");
                $stmt = $con->prepare( "SELECT username FROM `users` WHERE Username IN (?)");
                $stmt->bind_param('s', $username);
                $stmt->execute(); 
                $result = $stmt->get_result();
	$num_rows = mysqli_num_rows($result); 
	if ($num_rows != 0) 
		{ 
		echo "<h1>Sorry, the username ".$username." is already taken.</h1>";
		} 
	else 
		{
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);      
        $stmt = $con->prepare ("INSERT INTO `users` (Username, Password) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $hashedpass);
        $stmt->execute(); 
        //gets latest record (the one just posted)
        $stmt = $con->prepare ("SELECT `User ID` FROM `users` ORDER BY `User ID` DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = mysqli_fetch_array($result))
        { 
            // adds the user_id to another table. this is done to allow the record to be updated when the user adds address information
            $regid = $row['User ID'];
                    $stmt = $con->prepare ("INSERT INTO `addresses` (User_ID) VALUES (?)");
                    $stmt->bind_param('s', $regid);
                    $stmt->execute();
        }
        $stmt->close();
		echo "<h1>Account Created</h1>";
		mysqli_close($con);
		}
?>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>