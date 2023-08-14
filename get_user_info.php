<?php
    session_start();
?>

<?php
    $user_email=$_SESSION['recipient_email'];
    $user_name= $_SESSION['recipient_name'];
    // $start_dt= $_SESSION['s_dateTime'];
    // $end_dt= $_SESSION['e_dateTime'];


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

    $a_id = $_SESSION['appoint_id'];
    // $a_id = 103;


    //time and date fetch
    $s_dateTime=0;
    $e_dateTime=0;
    $query6 = "SELECT `teacher_schedule_date`,`teacher_schedule_time` FROM `teacher_time_table` WHERE `appoinment_id`= $a_id";
    $result7 = mysqli_query($conn,$query6);
    while($row = $result7->fetch_assoc()) { 
        $date_= $row["teacher_schedule_date"];
        $time = $row['teacher_schedule_time'];
        if($time<10)
        {
            $s_dateTime= $date_.'T0'.$time.':00:00+05:30';     //2023-07-09T09:00:00+05:30
            if($time<9)
            {
                $e_dateTime=$date_.'T0'. $time+1 .':00:00+05:30';     //2023-07-09T09:00:00
            }
            else
            {
                $e_dateTime=$date_.'T'. $time+1 .':00:00+05:30';     //2023-07-09T10:00:00
            }
        }
        else
        {
            $s_dateTime= $date_.'T'.$time.':00:00+05:30';     //2023-07-09T10:00:00+05:30
            $e_dateTime= $date_.'T'. $time+1 .':00:00+05:30';
        }
    }
    mysqli_close($conn);

    //Array for asynchronous transfer
    $userInfo = array(
        'name' => $user_name,
        'email' => $user_email,
        'start' => $s_dateTime,
        'end' => $e_dateTime
    );
    echo json_encode($userInfo);
?>