<?php
    session_start();
    include_once("database.php");

    if(!isset($_SESSION['userid'])) {
        header("Location: login.php");
    }

    $user_id = $_SESSION['userid'];

    $staff = $_SESSION['staff'];

    $status = $_SESSION['status'];

    if($staff != 1) {
        header("Location: login.php");
    }

    function browser_alert($message) {
      echo "<script>alert('$message');</script>";
    }

?> 

<!DOCTYPE html>
<head>
    <title>Close Contacts | SLC COVID Tracker</title>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

      <?php
    if($_SESSION['status'] == 0) {
        echo "<li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>";
    }  

    ?>
    <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' data-toggle='dropdown'>
          User Status
        </a>
        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
          <a class='dropdown-item' href='status.php'>Positive Cases</a>
          <a class='dropdown-item disabled' href='#'>Close Contacts</a>
        </div>
      </li>

    </ul>
        <form class="form-inline my-2 my-lg-0" action="logout.php">
      <button class="btn btn-warning" type="submit">Logout</button>
    </form>
  </div>
</nav> 
<div class="mt-3">
<h1>Close Contacts</h1>
  </div>
<form method="POST" action="">
<div class="container">
    <div class="row">
    <div class="col-lg mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search by UserID or Name</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Press Enter to Search" name="query" Id="query" style="width:fit">
                    <input type="submit" name="Search" hidden />
                </div>
            </div>
    </div>
</div>
</form>
<div class="mt-3">
<?php 
  if(isset($_REQUEST['Search'])){
    ob_flush();
    $query = strtolower($_REQUEST['query']);
    $intquery = (int) $query;

    $sql = "SELECT DISTINCT u.FirstName, u.Surname, u.Email, s.Status, u.UserID, c.Day, c.Period, c.Subject, c.Room 
    FROM attendance as a 
    INNER JOIN users u ON (u.UserID = a.UserID) 
    INNER JOIN classes as c ON (a.ClassID = c.ClassID) 
    LEFT OUTER JOIN status as s ON (s.UserID = u.UserID)
    WHERE a.ClassID IN 
      (SELECT a.ClassID 
      FROM attendance as a 
      WHERE lower(u.FirstName) LIKE '$query'
      OR lower(u.Surname) LIKE '$query'
      OR a.UserID LIKE $intquery)";

      if($result = mysqli_query($connection, $sql)){
          ob_start();
          if(mysqli_num_rows($result) > 0){
              echo "<table class='table'>";
                  echo "<thead><tr>";
                      echo "<th scope='col'>First Name</th>";
                      echo "<th scope='col'>Surname</th>";
                      echo "<th scope='col'>Email</th>";
                      echo "<th scope='col'>Status</th>";
                      echo "<th scope='col'>Day</th>";
                      echo "<th scope='col'>Period</th>";
                      echo "<th scope='col'>Subject</th>";
                      echo "<th scope='col'>Room</th>";
                  echo "</tr></thead>";
              while($row = mysqli_fetch_array($result)){
                  echo "<tbody><tr>";
                      echo "<td>" . $row['FirstName'] . "</td>";
                      echo "<td>" . $row['Surname'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      if($row['Status'] == 1) {
                          echo "<td>" . "Positive". "</td>";
                      }
                      else {
                          echo "<td>" . "Negative" . "</td>";
                      }
                      echo "<td>" . $row['Day'] . "</td>";
                      echo "<td>" . $row['Period'] . "</td>";
                      echo "<td>" . $row['Subject'] . "</td>";
                      echo "<td>" . $row['Room'] . "</td>";
                  echo "</tr></tbody>";
              }
              echo "</table>";
              // Free result set
              mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
  }

?>
</div>

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