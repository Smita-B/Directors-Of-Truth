<?php
    include("config.php");
    session_start();
?>
<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PhpMailer/src/Exception.php';
	require 'PhpMailer/src/PHPMailer.php';
	require 'PhpMailer/src/SMTP.php';

	$msg = "";
    $name_err=$username_err=$password_err=$msg="";
	if(isset($_POST["send"]))
	{
		$code=mysqli_real_escape_string($conn,rand(10000,100000));
        if(empty($_POST['NAME']))
            $name_err="Name has to be entered";
        else
            $name=$_POST['NAME'];

        $_SESSION['otp']=$code;
        $_SESSION['name']=$name;

        $email=$_POST['EMAIL_ID'];
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST["USERNAME"]))
            $username_err = "Username can only contain letters, numbers, and underscores.";
        else
        $username = $_POST["USERNAME"];
        if(strlen($_POST["PASSWORD"]) < 6 )
            $password_err = "Password must have atleast 6 characters.";
        else
            $password = $_POST["PASSWORD"];

        $_SESSION['email']=$email;
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;

        if(empty($username_err) && empty($name_err) && empty($password_err))
        {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_registration WHERE EMAIL_ID='{$email}'")) > 0) 
            {
                $msg = "<div class='alert alert-danger'>{$email} - This email address already exists.</div>";
            } 
            else 
            {
                
                $result=mysqli_query($conn,"insert into USER_REGISTRATION(NAME,EMAIL_ID,USERNAME,PASSWORD) values('$name','$email','$username','$password')");
                if($result)
                {
                	$mail=new PHPMailer(true);
					$mail->IsSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPAuth = true; 
					$mail->Username = "oindrilapathak2020@gmail.com";
					$mail->Password = "xzrpiqkyiowrdnzi";
					$mail->SMTPSecure = "ssl";  
					$mail->Port = "465";
                   
					$mail->setFrom('oindrilapathak2020@gmail.com');
					$mail->AddAddress($email);
					$mail->IsHTML(true);

					$mail->subject="no reply";
					$mail->Body    = 'Here is your DOT verification code <b>'.$code.'</b>';

					$mail->send();

					echo 
					"
						<script> 
							alert('Sent Successfully'); 
							document.location.href='verify.php';
						</script>
					";
				}
				else 
                {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            }
		}
		else
        {
             $msg= "Error: " . $result . "<br>" . $conn->error;
        }  
	}
$conn->close();
?>