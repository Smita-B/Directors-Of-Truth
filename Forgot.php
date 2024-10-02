<?php
include("config.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PhpMailer/src/Exception.php';
    require 'PhpMailer/src/PHPMailer.php';
    require 'PhpMailer/src/SMTP.php';


if (isset($_POST['submit'])) 
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code=mysqli_real_escape_string($conn,rand(10000,100000));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_registration WHERE EMAIL_ID='{$email}'")) > 0) 
        {   
                    $query = mysqli_query($conn, "UPDATE user_registration SET CODE='{$code}' WHERE EMAIL_ID='{$email}'");

        if ($query) 
        {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail=new PHPMailer(true);
                    $mail->IsSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true; 
                    $mail->Username = "oindrilapathak2020@gmail.com";
                    $mail->Password = "xzrpiqkyiowrdnzi";
                    $mail->SMTPSecure = "ssl";  
                    $mail->Port = "465";

                    $mail->setFrom('oindrilapathak2020@gmail.com','DOT-Mail');
                    $mail->AddAddress($email);
                    $mail->IsHTML(true);
                    $mail->Subject = 'no reply';
                $mail->Body    = 'Here is the verification link <b><a href="http://localhost/Dot land/change-password.php?reset='.$code.'">http://localhost/Dot land/change-password.php?reset='.$code.'</a></b>';

                $mail->send();
               echo 
                    "
                        <h2><font color='yellow'>Please Check Your email address and click on the verification link</font></h2>    
                    ";
        }
    }
         else 
        {
        $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
        }
    } 

   
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="container">
        <form action='' method="POST">
        <div class="form signup">
            <h2>Enter your Registered Email Id</h2>
            <div class="inputBox">
                <input type="text" required="required" name="email">
                <i class="fa-solid fa-envelope"></i>
                <span>Email ID</span>
            </div>
            <div class="inputBox">
            <div>
                <input type="submit" value="Reset" name="submit">
            </div>
        </div>
        </div>
    </form>
</div>
</body>
</html>