<?php
// Start the session
session_start();
?>

<!-- dashboard.html -->
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <title>PLanClock</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style2.css" rel="stylesheet">

</head>

<!-- Topbar Start -->
<div class="container-fluid bg-dark px-5 d-none d-lg-block">
  <div class="row gx-0">
    <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
      <!-- <div class="d-inline-flex align-items-center" style="height: 45px;">
        <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i> WE Provide This Service Now!!</small>

      </div> -->
    </div>
    <div class="col-lg-4 text-center text-lg-end">
      <div class="d-inline-flex align-items-center" style="height: 45px;">
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
            class="fab fa-twitter fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
            class="fab fa-facebook-f fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
            class="fab fa-linkedin-in fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
            class="fab fa-instagram fw-normal"></i></a>
        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i
            class="fab fa-youtube fw-normal"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid position-relative p-0">
  <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="index.html" class="navbar-brand p-0">
      <h1 class="m-0"><img src="img/PlanClock.png" width="100px" height="100px">
        PlanClock</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0">
        <a href="index.php" class="nav-item nav-link ">Home</a>
        <a href="dashboard.php" class="nav-item nav-link active">Dashboard</a>
        <a href="time_table.php" class="nav-item nav-link ">Time Table</a>
        <a href="appointment.php" class="nav-item nav-link ">Make Appointment</a>
        <a href="existing.php" class="nav-item nav-link">Existing Appointment</a>
        <a href="index.php" class="nav-item nav-link">Logout</a>
      </div>

    </div>
</div>
</nav>
<!-- Navbar  End -->

<br>

<div class="headline1">
  <center>
    <h2> <b> Welcome to Dashboard </b> </h2>
  </center>
</div>
<br><br><br>
<<center>
  <div class="container">
    <div class="profile-details">
      <h3>
        <center> Profile Details </center>
      </h3>
      <center><img src="PlanClock.png" width="100px" height="100px"> </center>


      <br>
      <br>
      <p><strong>Name: </strong>

        <?php

        $sid = $_SESSION["Student_user_id"];

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "planclock";

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $query = "select student_first_name, student_last_name from student where student_id = $sid;"; //all the appoinments of the student
        
        $result = mysqli_query($conn, $query);

        while ($row = $result->fetch_assoc()) {
          echo $row['student_first_name'] . " " . $row['student_last_name'];
        }

        ?>
      </p>
      <p><strong>User Type: </strong>

        <?php
        echo "Student";
        ?>
      </p>
      <p><strong>Email id:- </strong>

        <?php

        $sid = $_SESSION["Student_user_id"];

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "planclock";

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $query = "select student_email from student where student_id = $sid;"; //all the appoinments of the student
        
        $result = mysqli_query($conn, $query);

        while ($row = $result->fetch_assoc()) {
          echo $row['student_email'];
        }
        ?>

      </p>
    </div>
  </div>
  </center>

  </body>

</html>