<?php
    session_start();
?>

<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $id=$_SESSION['Student_user_id'];
    $ufac_id= $_POST['fac_name'];
    $date= $_POST['date'];
    $utime = $_POST['time'];
    $uday= $_POST['day'];
    $rea = $_POST['reason'];

    $udate = date('Y-m-d', strtotime($date));

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "planclock";

    //Databse connection
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Creating new appointment id
    $query1 = "select max(appoinment_id) from appoinment_table";
    $result1 = mysqli_query($conn,$query1);
    $max= 0;
    
    while($row = $result1->fetch_assoc()) {
        $max= $row['max(appoinment_id)'];
      }
    $max = $max+1;

    //Finding free slot available or not based on fixed time table
    $query3= "select free_slot from $uday where teacher_id = $ufac_id and free_slot= $utime ;";
    $result3 = mysqli_query($conn,$query3);


    if(mysqli_num_rows($result3) > 0) {

        //Storing new appointment id, teacher id, student id who booked  with reason and marking it as confirmed
        $query2 = "insert into appoinment_table values( $max, $ufac_id, $id, '$rea', 'Pending' );";
        $result2 = mysqli_query($conn,$query2);

        //booking date and time in teacher table
        $query4 = "insert into teacher_time_table values( $ufac_id, $max , '$udate', $utime );";
        $result4 = mysqli_query($conn,$query4);

        $query5 = "SELECT `teacher_email`, `teacher_name` FROM `teacher` WHERE `teacher_id` = $ufac_id";
        $result6 = mysqli_query($conn,$query5);
        while($row = $result6->fetch_assoc()) { 
            $email= $row["teacher_email"];
            $name = $row['teacher_name'];

            //Mail Sent Code....

            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function

           //Load Composer's autoloader
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';
            require 'PHPMailer/Exception.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'planclock2023@gmail.com';                     //SMTP username
                $mail->Password   = 'jrkfpuadfujfdzlu';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('planclock2023@gmail.com', 'Plan Clock');
                $mail->addAddress($email, 'A User');     //Add a recipient
                
                //Content
                $mail->isHTML(true);                                    //Set email format to HTML
                $mail->Subject = 'PlanClock-New Appointment Request';
                $mail->Body    = "Dear $name, <br><br> We hope this email finds you well. <br> We wish to inform you that a appointment has Been requested by $id for $rea. Kindly approve on decline it. <br><br> Regards, <br> PlanClock ";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        }

        echo "<script>alert('Appointment Confirmed. Appointment Id = $max');</script>";
        echo "<script> location.href = 'dashboard.php' </script>";

    }
    else {
        echo "<script>alert('Appoinment Failed. Kindly select some other time');</script>";
        echo "<script> location.href = 'appointment.php' </script>";
        
    }

   
?>

