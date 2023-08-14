<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
  <link href="css/style1.css" rel="stylesheet">

</head>

<body>

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
          <a href="teacher_dashboard.php" class="nav-item nav-link">Dashboard</a>
          <a href="teacher_time_table.php" class="nav-item nav-link ">Time Table</a>
          <a href="teacher_make.php" class="nav-item nav-link ">Make Appointment</a>
          <a href="teacher_existing.php" class="nav-item nav-link active">Existing Appointment</a>

        </div>
        <a href="index.php" class="nav-item nav-link">Logout</a>
      </div>

  </div>
  </nav>
  <!-- Navbar  End -->
  <header class="headline">
    <center>
      <h2 class="tab-space"> <b> Manage Booking </b> </h2>
      <br><br>
    </center>
  </header>

  <article style="display: flex; position-relative;">
    <div class="existing-details">
      <table>
        <tr>
          <th>Sl. no</th>
          <th>Appointment Id</th>
          <th>Name</th>
          <th>Date</th>
          <th>Time</th>
          <th>Reason </th>
          <th>Appointment Status</th>
          <th>Action </th>
          <?php

          $sidi = $_SESSION['teacher_user_id'];

          // Database connection parameters
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


          $query = "select * from appoinment_table where teacher_id = $sidi or student_id = $sidi;"; //all the appoinments of the teacher
          
          $result = mysqli_query($conn, $query);
          $sl = 1;
          if (mysqli_num_rows($result) > 0) {

            while ($row = $result->fetch_assoc()) {
              $tid = $row["student_id"];
              $apoint = $row["appoinment_id"];

              if ($tid > 1000) {
                $qur = "select student_first_name from student where student_id = $tid;";
                $res = mysqli_query($conn, $qur);
                $rw = $res->fetch_assoc();

                $qur2 = "select teacher_schedule_date, teacher_schedule_time from teacher_time_table where appoinment_id = $apoint;";
                $res2 = mysqli_query($conn, $qur2);
                $rw2 = $res2->fetch_assoc();

                echo "<tr>";
                echo "<td>" . $sl . "</td>";
                echo "<td>" . $apoint . "</td>";
                echo "<td>" . $rw["student_first_name"] . "</td>";
                echo "<td>" . $rw2["teacher_schedule_date"];
                echo "<td>" . $rw2["teacher_schedule_time"] . ":00";
                echo "<td>" . $row["reason"];
                echo "<td>" . $row["status"];

                if ($row["status"] == "Pending" && $row['student_id'] != $sidi) {
                  echo "<td>" . '<a href="approve.php?a_id=' . $apoint . '&status=0"> 
                                    <img src="tick.png" alt="Approve Image" style="width: 18px; height: 18px;"></a>' . " " .
                    '<a href="cancel.php?a_id=' . $apoint . '&status=0" > 
                                    <img src="cross.png" alt="Cancel Image" style="width: 18px; height: 18px;"></a>';
                } else if ($row["status"] == "Confirmed" && $row['student_id'] != $sidi) {
                  echo "<td>" . "&nbsp;&nbsp;&nbsp;&nbsp;" . '<a href="cancel.php?a_id=' . $apoint . '&status=0" > 
                                    <img src="cross.png" alt="Cancel Image" style="width: 18px; height: 18px;"></a>';
                } else {
                  echo "<td>" . " ";
                }

                echo "</tr>";
                $sl = $sl + 1;
              } else {
                $qur = "select teacher_name from teacher where teacher_id = $tid;";
                $res = mysqli_query($conn, $qur);
                $rw = $res->fetch_assoc();

                $qur2 = "select teacher_schedule_date, teacher_schedule_time from teacher_time_table where appoinment_id = $apoint;";
                $res2 = mysqli_query($conn, $qur2);
                $rw2 = $res2->fetch_assoc();

                echo "<tr>";
                echo "<td>" . $sl . "</td>";
                echo "<td>" . $apoint . "</td>";
                echo "<td>" . $rw["teacher_name"] . "</td>";
                echo "<td>" . $rw2["teacher_schedule_date"];
                echo "<td>" . $rw2["teacher_schedule_time"] . ":00";
                echo "<td>" . $row["reason"];
                echo "<td>" . $row["status"];

                if ($row["status"] == "Pending" && $row['student_id'] != $sidi) {
                  echo "<td>" . '<a href="approve.php?a_id=' . $apoint . '&status=0"> 
                                    <img src="tick.png" alt="Approve Image" style="width: 18px; height: 18px;"></a>' . " " .
                    '<a href="cancel.php?a_id=' . $apoint . '&status=0" > <img src="cross.png" alt="Cancel Image" style="width: 18px; height: 18px;"></a>';
                } else if ($row["status"] == "Confirmed" && $row['student_id'] != $sidi) {
                  echo "<td>" . "&nbsp;&nbsp;&nbsp;&nbsp;" . '<a href="cancel.php?a_id=' . $apoint . '&status=0" >    
                                    <img src="cross.png" alt="Cancel Image" style="width: 18px; height: 18px;"></a>';
                } else {
                  echo "<td>" . " ";
                }

                echo "</tr>";
                $sl = $sl + 1;
              }
            }
          }
          mysqli_close($conn);
          ?>
      </table>
    </div>
  </article>
</body>

</html>