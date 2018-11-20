<?php 
// This stores the connection details to connect to mysql and which database to select. Since the website was worked on in 2 different enviroments the login details are set here and applied to the entire website. this makes changing the details quick and easy.

// REMEMBER TO ADD BACK THIS LINE WHEN MOVING BACK TO COLLEGE SERVER
//$con = mysqli_connect([REDACTED]);
//$con = mysqli_connect([REDACTED]);
$con = mysqli_connect("[REDACTED]);
   // Displays an error if mysqli can't connect.                                 
if ($con->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}
?>