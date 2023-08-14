<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>

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
                    <a href="admin_dashboard.php" class="nav-item nav-link">Dashboard</a>
                    <a href="profile_edit.php" class="nav-item nav-link active">Update Profile</a>
                    <a href="teacher_make.php" class="nav-item nav-link ">Make Appointment</a>
                    <a href="teacher_0existing.php" class="nav-item nav-link ">Existing Appointment</a>

                </div>
                <a href="index.php" class="nav-item nav-link">Logout</a>
            </div>

    </div>
    </nav>
    <!-- Navbar  End -->
    <br>
    <br>
    <br>
    <br>
    <br>

    <center>
        <h1>Update Profile</h1>
    </center>

    <br>
    <!-- <section class="contact" id="contact">
        <form action="edit.php" method="post">

            <span>Enter Student/Employee Id:</span>
            <input type="text" name="e_sid" class="box">

            <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit" value="search" name="submit">Submit</button>
            </div>

        </form>

    </section> -->
    <br><br><br>

    <center>
  <div class="container">
    <div class="profile-details">
      <h3>
        <center> Profile Details </center>
      </h3>
      <center><img src="PlanClock.png" width="100px" height="100px"> </center>


      <br>
      <br>
      <form action="update_profile.php" action="get">
      <p><strong>Name:  </strong><br>
      <input type="text" name ="new_name" value="

        <?php
        
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "planclock";
        
        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);
        $id = $_GET['e_sid'];
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        if($id>1000)
        {
            $query = "select student_first_name, student_last_name from student where student_id = $id;"; //all the appoinments of the student
            $result = mysqli_query($conn, $query);
        
            while ($row = $result->fetch_assoc()) {
            $name = $row['student_first_name'] . " " . $row['student_last_name'];
            }
        }
        else
        {
            $query = "select teacher_name from teacher where teacher_id = $id;";
            $result = mysqli_query($conn, $query);
        
            while ($row = $result->fetch_assoc()) {
            $name = $row['teacher_name'];
            }
        } 

        mysqli_close($conn);
        echo $name;
        
        ?>
        ">
      </p>
      <p><strong>User Type: </strong>
      <input type="text" value="
        <?php
            $id = $_GET['e_sid'];
            if($id>1000)
                echo "Student";
            else
                echo "Teacher";
        ?>
        " name ="user">
      </p>

      <p><strong>Email id:- </strong>

      <input type="text" name ="new_email" value="

        <?php

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "planclock";

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);
        $id = $_GET['e_sid'];
        $_SESSION['search_id']= $id;

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        if($id>1000)
        {
            $query = "select student_email from student where student_id = $id;"; //all the appoinments of the student
            $result = mysqli_query($conn, $query);

            while ($row = $result->fetch_assoc()) {
            $name = $row['student_email'];
            }
        }
        else
        {
            $query = "select teacher_email from teacher where teacher_id = $id;";
            $result = mysqli_query($conn, $query);

            while ($row = $result->fetch_assoc()) {
            $name = $row['teacher_email'];
            }
        
        }
        

        mysqli_close($conn);
        echo $name;

        ?>
        ">

        <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit" value="search" name="submit">Submit</button>
        </div>

</form>
      </p>
    </div>
  </div>
  </center>

    <br><br><br><br><br><br><br><br><br><br><br>

</body>

</html>