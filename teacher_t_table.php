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
        <a href="teacher_dashboard.php" class="nav-item nav-link">Dashboard</a>
        <a href="teacher_time_table.php" class="nav-item nav-link active">Time Table</a>
        <a href="teacher_make.php" class="nav-item nav-link ">Make Appointment</a>
        <a href="teacher_0existing.php" class="nav-item nav-link " >Existing Appointment</a>

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

    <center><h1>Time Table</h1></center>

  <br>

  <br><br><br><br><br><br><br><br><br><br><br>
  <div class="container1">
    <div class="existing-details">
      <table>
        <tr>
        <tr>
            <th>Day</th>
            <th>09:00 AM</th>
            <th>10:00 AM</th>
            <th>11:00 AM</th>
            <th>12:00 PM</th>
            <th>02:00 PM</th>
            <th>03:00 PM</th>
        </tr>
        <tr>
          <?php 
            
            $mydays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');

            foreach ($mydays as $day) {

              $host = "localhost";
              $username = "root";
              $password = "";
              $dbname = "planclock";

              $conn = new mysqli($host, $username, $password, $dbname);

              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $teach_id = $_POST['fac_name'];
              $date = "2023-04-14";
              
              $slot = 9;
              $free = "avail";
              $fre = "avail";
              $s=$slot;
              $slo=2;
              echo "<td>". $day;
   
              while($s <=12) { 
                  
                  $query= "select free_slot from $day where teacher_id = $teach_id and free_slot= $s; ";
                  
                  $result = mysqli_query($conn,$query); //10,12,2

                  $flag=0;

                  while( $row = $result->fetch_assoc()) {
                          
                      if($s == $row['free_slot'] ) {  
  
                          echo "<td>" . "Available". "</td>";                        
                          
                          $flag=1;
                      }
                  }

                  if($flag==0){
                          echo "<td>" . " " . "</td>";       
                  }
                  $s=$s+1;       
              }

            $slot = 2;
            $free = "avail";
            $fre = "avail";
            $s=$slot;

            while($s <=3) { 
                
                $query= "select free_slot from $day where teacher_id = $teach_id and free_slot= $s; ";
                
                $result = mysqli_query($conn,$query); 

                $flag=0;

                while( $row = $result->fetch_assoc()) {
                        
                    if($s == $row['free_slot'] ) {  
                        
                        
                        echo "<td>" . "Available" . "</td>";                        
                       
                        $flag=1;
                    }
                }

                if($flag==0){
                        
                        echo "<td>" . " " . "</td>";                        
                        
                }
                $s=$s+1;
                
                
            }
            echo "</tr>";
          }
            mysqli_close($conn);
          
        ?> 

        </table>
    </div>
  </div>
</body>
</html>