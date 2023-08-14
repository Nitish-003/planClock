<?php
    session_start();
?>

<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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

    $a_id=$_GET['a_id'];
    $status = $_GET['status'];

    $query = "update appoinment_table set status= 'Cancelled' where appoinment_id=$a_id";
    mysqli_query($conn,$query);

//Mail Sent Code

    $bid;
    $email;
    $name;

    $query1="SELECT `student_id` FROM `appoinment_table` WHERE `appoinment_id`=$a_id";
    $result1 = mysqli_query($conn,$query1);
    while($row = $result1->fetch_assoc()) { 
        $bid= $row["student_id"];
    }

    if($bid>1000){
        $query5 = "SELECT `student_email`, `student_first_name` FROM `student` WHERE `student_id` = $bid";
        $result6 = mysqli_query($conn,$query5);
        while($row = $result6->fetch_assoc()) { 
            $email= $row["student_email"];
            $name = $row['student_first_name'];
        }      
    }
    else {
        $query5 = "SELECT `teacher_email`, `teacher_name` FROM `teacher` WHERE `teacher_id` = $bid";
        $result6 = mysqli_query($conn,$query5);
        
        while($row = $result6->fetch_assoc()) { 
            $email= $row["teacher_email"];
            $name = $row['teacher_name'];
        }
    }
    
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
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PlanClock- Appointment Cancelled';
            $mail->Body    = "Dear $name, <br>We hope this email finds you well. <br> We wish to inform you that your appointment  with $sidi has been Cancelled. <br><br> Regards, <br> PlanClock ";

            $mail->send();
            echo 'Message has been sent';
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    header('location:teacher_existing.php');

?>