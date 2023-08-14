<?php
// Start the session
session_start();
?>
<?php                         
    $id= $_POST['enter_name'];
    $pwd= $_POST['enter_password'];
    if($id =="" || $pwd=="")
    {
        echo "<script> location.href = 'login.html' </script>";
        echo "Enter the Details";
    }
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "planclock";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Log In User Id and Password Check to give user access to dashboard and account access. 
    $query= "select * from student where student_id = $id and student_password = $pwd;";   //all the appoinments of the student
    $result = mysqli_query($conn,$query);
    $sl=1;
    if(mysqli_num_rows($result) > 0) {
 
        $_SESSION["Student_user_id"]=$id; 
        echo $_SESSION["Student_user_id"];       
        echo "<script> location.href = 'dashboard.php' </script>";
    
    }
    else {
        session_destroy();
        echo "<script>alert('Wrong password. Please try again.');</script>";
        echo "<script> location.href = 'login.html' </script>";
    }

?>
