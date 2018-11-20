  <script type="text/javascript">
// This function controls the hiding and showing the bars 
    function toggle_account(id) {
        //hides all bars first
        $("#AccountBarLogin").hide("fast");
        $("#AccountBarRegister").hide("fast");
        //Shows the bar via the ID sent when the menu button was clicked
        $(id).show("fast");
        
    }
</script>

<?php
//Error reporting is stopped because it throughs a warning about the session varible if not set. Not an issue with the code so it is hidden
error_reporting(E_ALL & ~E_NOTICE);
//checks if the user is logged in
           if ($_SESSION['LoggedIn'] == "Yes") {
               // if they are set a varible to the name in the session varible. Session varible isn't used because it breaks the HEREDOC ECHO
               $username = $_SESSION['Name'];
               // a button is created with the user's name on it
echo <<<END
               <div id = AccountBar>
               
                <a href="#" onclick="toggle_account('#AccountBarSettings')">$username<span style="font-size: 10px">▼</span></a>
        </div>
<div id = AccountBarSettings>
        <div class = UserGateway>
END;
//    Checks if the user is an admin. If they are show one option, if not, another.
        if ($_SESSION['Admin'] == 0) {
            echo "<a href='AccountSettings.php'> Update Account Settings</a>";
        } elseif ($_SESSION['Admin'] == 1) {
            echo "<a href='OutstandingOrders.php'> View Outstanding Orders</a>";
        }
       //adds signout button 
   echo " <a href='Signout.php'> Sign Out</a>
        </div>
    </div>";  

         } else { 
             //if they are not logged in show login and register buttons with thier bars
echo <<<END
		 <div id = AccountBar>
    
     <a href="#" onclick="toggle_account('#AccountBarLogin')">Login<span style="font-size: 10px">▼</span></a>
        <a href="#" onclick="toggle_account('#AccountBarRegister')">Register<span style="font-size: 10px">▼</span></a>
    </div>

<div id = AccountBarLogin>
    <div class = UserGateway>
             <form action='Login.php' method='post'>
    <input type="text" name="login_username" placeholder="Username" />
    <input type="password" name="login_password" placeholder="Password" />
    <input type="submit" value="Login" name="Login" />
    </form>
        
    </div>
    
</div>

<div id = AccountBarRegister>
    <div class = UserGateway>
    <form action='Register.php' method='post'>
    <input type="text" name="register_username" placeholder="Username" />
    <input type="password" name="register_password" placeholder="Password" />
    <input type="submit" value="Register" name="Register" />
    </form>
    </div>
</div>
END;
		 }

                 ?>