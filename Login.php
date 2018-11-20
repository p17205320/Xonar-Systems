
<?php
include ("setup.php");
?>

<head>
<!--    goes back to referer after 3 seconds-->
<meta http-equiv="Refresh" content="3; url=<?php echo $_SERVER['HTTP_REFERER'];?>"> 
<title>Xonar Systems - Login</title>
</head>
<body>
<div id = MainContainer>

    <?php include ("LogoBar.php");include ("AccountBar.php"); include ("NaviBar.php");?>
   
<?php
    include("connect.php");
       // this adds the filtered post varibles to a varible
    $username = filter_input(INPUT_POST, "login_username");
                $password = filter_input(INPUT_POST, "login_password");
       $stmt = $con->prepare( "SELECT * FROM users WHERE Username = (?)");
    // This binds the username to the username array from POST
       $stmt->bind_param('s', $username);
    // runs the statement
        $stmt->execute();
    // puts the result into an array
        $result = $stmt->get_result();
            // puts the hash from the database
            while($row = mysqli_fetch_array($result))
		{
		$hash = $row['Password'];
                $id = $row['User ID'];
                $admin = $row['Is Admin'];
		}
                // Verifys that the password given by the user matches the hash from the database
                if (password_verify($password, $hash)) {
                    //If the password is verified these varibles are set in session array
                    $_SESSION['LoggedIn'] = "Yes";
                    $_SESSION['Name'] = $username;
                    $_SESSION['User_ID'] = $id;
                    $_SESSION['Admin'] = $admin;
                    echo "<h1>Login Successful!</h1>";
                    } else {
                        echo '<h1>Invalid password.</h1>';
                    }
			
    mysqli_close($con);
?>
        <?php include ("FooterBar.php") ?>
</div>
    
</body>