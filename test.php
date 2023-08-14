<?php

$s_dateTime = 0;
$e_dateTime = 0;
// $query6 = "SELECT `teacher_schedule_date`,`teacher_schedule_time` FROM `teacher_time_table` WHERE `appoinment_id`= $a_id";
// $result7 = mysqli_query($conn, $query6);


//while ($row = $result6->fetch_assoc()) {
    // $date_ = $row["teacher_schedule_date"];
    // $time_ = $row['teacher_schedule_time'];

    // $date_ = '2023-03-01';
    // $time = '9';
    // if ($time < 10) {
    //     $s_dateTime = $date_ . 'T0' . $time . ':00:00+05:30'; //2023-07-09T09:00:00+05:30
    //     if ($time < 9) {
    //         $e_dateTime = $date_ . 'T0' . $time + 1 . ':00:00+05:30'; //2023-07-09T09:00:00
    //     } else {
    //         $e_dateTime = $date_ . 'T' . $time + 1 . ':00:00+05:30'; //2023-07-09T10:00:00
    //     }
    // } else {
    //     $s_dateTime = $date_ . 'T' . $time . ':00:00+05:30'; //2023-07-09T10:00:00+05:30
    //     $e_dateTime = $date_ . 'T' . $time + 1 . ':00:00+05:30';
    // }

    // echo $s_dateTime .'\n';
    // echo $e_dateTime . '\n';
//}

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

    // $a_id = $_SESSION['appoint_id'];
    $a_id = 103;

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

    echo $s_dateTime .'\n-';
    echo $e_dateTime . '\n';


    // $_SESSION['s_dateTime'] = $s_dateTime;
    // $_SESSION['e_dateTime'] = $e_dateTime;

?>