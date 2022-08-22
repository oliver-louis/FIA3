<?php
    session_start();
    include_once("database.php");
    // Redirect if not Logged In
    if(!isset($_SESSION['userid'])) {
        header("Location: login.php");
    }

    $user_id = $_SESSION['userid'];
    $staff = $_SESSION['staff'];

    function browser_alert($message) {
      echo "<script>alert('$message');</script>";
    }

?> 
<!DOCTYPE html>
<head>
    <title>Register | SLC COVID Tracker</title>
    <!-- Import External Style Sheets and Scripts -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Define Jquery function for datepicker -->
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();  
        });
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="https://www.slc.qld.edu.au/images/menu-logo.png" height="50vh" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
</nav>

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#">Register<span class="sr-only">(current)</span></a>
      </li> 

      
      <?php
      // Only Show Staff Controls if User is Staff
    if($_SESSION['staff'] == 1) {
        echo "<li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' data-toggle='dropdown'>
          User Status
        </a>
        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
          <a class='dropdown-item' href='status.php'>Positive Cases</a>
          <a class='dropdown-item' href='contacts.php'>Close Contacts</a>
        </div>
      </li>";
    }  

    ?>
    </ul>
        <form class="form-inline my-2 my-lg-0" action="logout.php">
      <button class="btn btn-warning" type="submit">Logout</button>
    </form>
  </div>
</nav>  
<div class="container">
    <div class="text-center mt-3">
        <h1>Register as COVID19 Positive</h1>
    </div>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="container">
                  <!-- Registration Form -->
                    <form autocomplete="off" action="" method="post">
                    <div class="controls">
                        <div class="row">
                            <div class="form-group">

                          
<?php
  // Start Output Buffering
  ob_start();

  // Show different form for Staff to submit other people
  if($_SESSION['staff'] == 1) {
    echo "
    <label for='UID'>UserID of Case</label>
    <input type='text' name='UID' placeholder='Leave Blank to Self Report'><br>
    <label for='form_name'>Date of Positive Result</label>
    <input type='text' name='date' id='datepicker'>
    <br></br>
    <input type='checkbox' id='confirmation' name='confirmation' required>
    <label for='checkbox'><i>I confirm that the above information is accurate to the best of my ability.</i></label><br>
    <input class='btn btn-warning' type='submit' name='submit' value='Register'><br>

    ";
  }
  // Show different form for Student
  else {
    echo "
    <label for='form_name'>Date of Positive Result</label>
    <input type='text' name='date' id='datepicker'>
    <br></br>
    <input type='checkbox' id='confirmation' name='confirmation' required>
    <label for='checkbox'><i>I confirm that the above information is accurate to the best of my ability.</i></label><br>
    <input class='btn btn-warning' type='submit' name='submit' value='Register'><br>
    ";
  }
  // On Form Submit
    if(isset($_REQUEST['submit'])){
        if(!empty($_REQUEST['date'])){
          // Generate Isolation End Date based on Start Date
          $isoStart = strtotime($_REQUEST['date']);
          $isoEnd = date('Y-m-d', strtotime($_REQUEST['date'] . '+ 14 days'));
          $isoStart = date('Y-m-d', $isoStart);
          $currentDate = date('Y-m-d');
          
          if(empty($_REQUEST['UID'])){
            if($isoStart <= $currentDate){
              $sql_fkcheck = "set FOREIGN_KEY_CHECKS=0";
              mysqli_query($connection, $sql_fkcheck);
              
              // Query to Insert
              $sql_insert = "INSERT INTO `status`(`UserID`, `Status`, `IsoStart`, `IsoEnd`) VALUES ($user_id,1,'$isoStart','$isoEnd')";
  
              mysqli_query($connection, $sql_insert);
              mysqli_close($connection);

              // Echo Confirmation
              echo "<br>You have successfully registered as COVID-19 Positive";
              echo "<p>Your isolation end date is $isoEnd</p>";
              // Redirect to Index in 3 seconds
              header( "refresh:3;url=index.php" );
              
          } else {
            // Else date is in the future
            $error = "Invalid Date. This date cannot be in the future.";
            browser_alert($error);
          }}
          // Custom Report for Staff with Specific User ID
          elseif(!empty($_REQUEST['UID'])){
            $reported_userid = (int) $_REQUEST['UID'];
            $sql_fkcheck = "set FOREIGN_KEY_CHECKS=0";
            mysqli_query($connection, $sql_fkcheck);
              
            $sql_insert = "INSERT INTO `status`(`UserID`, `Status`, `IsoStart`, `IsoEnd`) VALUES ($reported_userid,1,'$isoStart','$isoEnd')";

            mysqli_query($connection, $sql_insert);

            $reported_name_query = "SELECT * FROM users WHERE UserID = $reported_userid";
            $result = mysqli_query($connection, $reported_name_query);
            $cred_array = mysqli_fetch_array($result);

            $reported_name = $cred_array['FirstName'] . " " . $cred_array['Surname'];
            mysqli_close($connection);
            echo "<br>You have successfully registered <b>$reported_name</b> as COVID-19 Positive";
            echo "<p>Their isolation end date is $isoEnd</p>";
          }
        }
    else{
        echo "<error>Please insert a date</error>";
    }
    }

?>
</form>
 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="mt-auto text-center text-lg-start bg-white text-muted">
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 text-grayish"></i>St Laurence's College
          </h6>
          <p>
            A Catholic School for boys in the Edmund Rice Tradition since 1915.
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="https://www.qld.gov.au/health/conditions/health-alerts/coronavirus-covid-19" class="text-reset">QLD Health COVID</a>
          </p>
          <p>
            <a href="https://slc4.sharepoint.com/teams/LauriesNet/" class="text-reset">LauriesNet</a>
          </p>
          <p>
            <a href="https://tass.slc.qld.edu.au/studentcafe" class="text-reset">Student Café</a>
          </p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3 text-grayish"></i>82 Stephens Road, South Brisbane, QLD, Australia</p>
          <p>
            <i class="fas fa-envelope me-3 text-grayish"></i>
            covidtracker@slc.qld.edu.au
          </p>
          <p><i class="fas fa-phone me-3 text-grayish"></i>07 3010 1111</p>
        </div>
      </div>
    </div>
  </section>
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © <?php echo date("Y"); ?> Copyright: Oliver Thornthwaite
  </div>
</footer>
</body>
</html>