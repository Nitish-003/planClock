<?php
// Start the session
session_start();
?>

<?php                         
    $emp_id= $_POST['eid'];
    $pwd= $_POST['epassword'];
    

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

    $query= "select * from teacher where teacher_id = $emp_id and teacher_password = $pwd;";   //all the appoinments of the student

    $result = mysqli_query($conn,$query);
    $sl=1;
    if(mysqli_num_rows($result) > 0) {
        
        $_SESSION["teacher_user_id"] = $emp_id;
        echo "<script> location.href = 'teacher_dashboard.php' </script>";
    
    }
    else {
        session_destroy();
        echo "<script>alert('Wrong password. Please try again.');</script>";
        echo "<script> location.href = 'teacher_login.html' </script>";
    }
?>
