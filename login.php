<?php
    session_start();
    session_unset();
    include_once("database.php");
?>
<!DOCTYPE html>
    <head>
        <!-- External CSS and JS -->
        <link rel="stylesheet" href="login_style.css">
        <script src="script.js"></script>

        <title>Login | SLC COVID Tracker</title>
    </head>

<body scroll="no" style="overflow: hidden">
<div class="bg-img">
    <!-- Login Form -->
    <form method="POST" action="" class="container">
        <img src='https://www.slc.qld.edu.au/images/menu-logo.png'>
        
        <!-- Username -->
        <label for="email"><b>Username</b></label>
        <input type="text" name="LoginUsername" placeholder="Enter Username" required>

        <!-- Password -->
        <label for="password"><b>Password</b></label>
        <input type="Password" Id="LoginPassword" name="LoginPassword" placeholder="Enter Password" required>

        <!-- Submit -->
        <button type="submit" class="btn" name="LoginSubmit">Login</button>

<?php
    // When Form Submitted
    if(isset($_REQUEST['LoginSubmit'])) {
        // Check if Input Fields are Empty
        if(!empty($_REQUEST['LoginUsername']) && !empty($_REQUEST['LoginPassword'])) {

            function incorrectpassword() {
                echo "<h3>Incorrect Username or Password</h3>";
            }

            // Store Credentials as Variables
            $username =  $_REQUEST['LoginUsername'];
            $password =  $_REQUEST['LoginPassword'];

            // Query DB for credentials
            $sql_select = "SELECT * FROM users WHERE Email = '$username' LIMIT 1";
            $result = mysqli_query($connection, $sql_select);
            $cred_array = mysqli_fetch_array($result);
            $dbPassword = $cred_array['Password'];
            
            // If Database Password matches Input Password
            if($dbPassword == $password){
                
                // Store User Information
                $_SESSION['email'] = $cred_array['Email'];
                $_SESSION['FirstName'] = $cred_array['FirstName'];
                $_SESSION['userid'] = $cred_array['UserID'];
                $_SESSION['staff'] = $cred_array['Staff'];  
                
                // Redirect to Index
                header("location: index.php");
                
            }
            else{
                incorrectpassword();
            }
        }
    }
?>
    </form>
</div>
</body>
</html>