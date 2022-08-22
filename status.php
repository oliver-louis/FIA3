<?php
    session_start();
    include_once("database.php");

    // Check if Signed in
    if(!isset($_SESSION['userid'])) {
        // Redirect to Login if not authenticated
        header("Location: login.php");
    }

    $user_id = $_SESSION['userid'];
    $staff = $_SESSION['staff'];
    $status = $_SESSION['status'];

    if($staff != 1) {
        // Redirect to Login if not Staff
        header("Location: login.php");
    }

    // Function for Javascript Browser Message
    function browser_alert($message) {
      echo "<script>alert('$message');</script>";
    }

?> 

<!DOCTYPE html>
<head>
    <title>Positive Cases | SLC COVID Tracker</title>

    <!-- Import External Styles and Scripts inc Bootstrap Framework -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- Import Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- Navigation Bar -->
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="https://www.slc.qld.edu.au/images/menu-logo.png" height="50vh" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
    <li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>
    <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' data-toggle='dropdown'>
          User Status
        </a>
        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
          <a class='dropdown-item disabled' href='#'>Positive Cases</a>
          <a class='dropdown-item' href='contacts.php'>Close Contacts</a>
        </div>
    </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="logout.php">
    <button class="btn btn-warning" type="submit">Logout</button>
    </form>
  </div>
</nav> 

<!-- Form for User Search -->
<form method="POST" action="">
<div class="container">
  <div class="text-center mt-3">
  <h1>Positive COVID-19 Cases</h1>
  </div>
  <div class="row">
    <div class="col">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Search by UserID or Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Press Enter to Search" name="query" Id="query" style="width:fit">
            <input type="submit" name="Search" hidden />
    </div>
    </div>
    <div class="col">
    <button class="btn btn-test" type="submit" name="AllPositive">Show All Positive Cases</button>
    </div>
  
</form>
</div>
</div>
<div class="mt-3">
<?php
// Show all Positive Cases
$showallpos = "SELECT u.FirstName, u.Surname, u.Email, u.UserID, s.Status FROM status as s INNER JOIN users u ON (u.UserID = s.UserID)";
if(isset($_REQUEST['AllPositive'])){
  // Connect to Database
    if($result = mysqli_query($connection, $showallpos)){
      // Start Output Buffering (Multiple Searches)
        ob_start();
        // Loop for each row of results
        if(mysqli_num_rows($result) > 0){
            echo "<table class='table'>";
                echo "<thead><tr>";
                    echo "<th scope='col'>First Name</th>";
                    echo "<th scope='col'>Surname</th>";
                    echo "<th scope='col'>Email</th>";
                    echo "<th scope='col>UserID</th>";
                    echo "<th scope='col'>Status</th>";
                echo "</tr></thead>";
            while($row = mysqli_fetch_array($result)){
                echo "<tbody><tr>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['Surname'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['UserID'] . "</td>";
                    // Convert Bool to Positive/Negative
                    if($row['Status'] == 1) {
                        echo "<td>" . "Positive". "</td>";
                    }
                    else {
                        echo "<td>" . $row['Status'] . "</td>";
                    }
                echo "</tr></tbody>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $showallpos. " . mysqli_error($link);
    }
}

// Search using Search Bar
if(isset($_REQUEST['Search'])) {
    if(!empty($_REQUEST['query'])) {
      // Clear Output Buffering
        ob_flush();
        
        // Convert Input into lowercase string, and integer for query
        $query = strtolower($_REQUEST['query']);
        $intQuery = (int) $query;

        // Query to Search DB using User Input
        $query = "SELECT u.FirstName, u.Surname, u.Email, u.UserID, s.Status
        FROM status as s
        INNER JOIN users u ON (u.UserID = s.UserID)
        WHERE lower(u.FirstName) LIKE '$query'
        OR lower(u.Surname) LIKE '$query'
        OR u.UserID LIKE $intQuery";

        // Connect to DB
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) > 0){
            echo "<table class='table'>";
                echo "<thead><tr>";
                    echo "<th scope='col'>First Name</th>";
                    echo "<th scope='col'>Surname</th>";
                    echo "<th scope='col'>Email</th>";
                    echo "<th scope='col'>UserID</th>";
                    echo "<th scope='col'>Status</th>";
                echo "</tr></thead>";
            // Loop for each row of results
            while($row2 = mysqli_fetch_array($result)){
                echo "<tbody><tr>";
                    echo "<td>" . $row2['FirstName'] . "</td>";
                    echo "<td>" . $row2['Surname'] . "</td>";
                    echo "<td>" . $row2['Email'] . "</td>";
                    echo "<td>" . $row2['UserID'] . "</td>";
                    if($row2['Status'] == 1) {
                        echo "<td>" . "Positive". "</td>";
                    }
                    else {
                        echo "<td>" . $row2['Status'] . "</td>";
                    }
                echo "</tr></tbody>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } 

}
?>
</div>
<!-- Footer -->
<footer class="mt-auto text-center text-lg-start bg-white text-muted">
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 text-grayish"></i>St Laurence's College
          </h6>
          <p>A Catholic School for boys in the Edmund Rice Tradition since 1915.</p>
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