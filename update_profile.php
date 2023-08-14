<?php
// Start the session
session_start();
?>

<?php
        
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "planclock";
    
    // Create a database connection
    $conn = new mysqli($host, $username, $password, $dbname);
    $id = $_SESSION['search_id'];

    $uname = $_GET['new_name'];
    $uemail = $_GET['new_email'];
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if($id>1000)
    {
        $query = "UPDATE `student` SET `student_email`= $uemail,`student_name`= $uname WHERE `student_id` = $id;"; //all the appoinments of the student
        $result = mysqli_query($conn, $query);
    
        while ($row = $result->fetch_assoc()) {
        $name = $row['student_first_name'] . " " . $row['student_last_name'];
        }
    }
    else
    {
        $query = "UPDATE `teacher` SET `teacher_email`= $uemail,`teacher_name`= $uname WHERE `teacher_id` = $id;"; //all the appoinments of the student
        $result = mysqli_query($conn, $query);
        
        while ($row = $result->fetch_assoc()) {
        $name = $row['teacher_name'];
        }
    } 

    mysqli_close($conn);
    echo $name;
    
    ?>