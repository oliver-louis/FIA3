<?php
    session_start();
    include_once("database.php");

    // Redirect if not Logged in
    if(!isset($_SESSION['userid'])) {
        header("Location: login.php");
    }

    $user_id = $_SESSION['userid'];

    // Query Users Status
    $query = "SELECT * FROM status WHERE UserID ='$user_id' ORDER BY IsoEnd ASC LIMIT 1";
    $result = mysqli_query($connection, $query);
    $cred_array = mysqli_fetch_array($result);
    mysqli_close($connection);

    $_SESSION['status'] = $cred_array['Status'];
?>
<!DOCTYPE html>
<head>
    <title>SLC COVID Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

<!-- Navigation Bar -->
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php
    // Show Register if User is Negative
    if($cred_array['Status'] != '1'){
        echo "<li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>";
    }
    // Show Staff Controls if User is Staff
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


<!-- Large Image Div for Header -->
<header class="masthead">
  <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
    <div class="d-flex justify-content-center">
      <div class="text-center">
<?php
    $first_name = $_SESSION['FirstName'];
    // Custom Welcome Message
    echo "<h1 class='mx-auto my-0 font-weight-bold'>Welcome, $first_name </h1>";

    $isoEnd = $cred_array['IsoEnd'];
    
    // Show Users Isolation End Date if Marked Negative
    if(!empty($isoEnd)){
        echo "<h2 class='text-white-50 mx-auto mt-2 mb-5 font-weight-light'>You have been marked as a Positive COVID-19 Case, your mandatory isolation period ends <b>$isoEnd</b></h2>";
    }
    // Show Intro and Option to Register if Negative
    else{
        echo "<h2 class='text-white-50 mx-auto mt-2 mb-5 font-weight-light'>Welcome to the St Laurence's College COVID Tracker. You currently are not marked as a Positive COVID-19 Case. If you have recently tested positive, please register your infection and isolate in accordance to QLD Health Guidelines.</h2>
            <a class='btn btn-mast' href='register.php'>Register as Positive</a>";
    }

?>
</div>
</div>
</div>
</header>
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
</div>
</body>
</html>