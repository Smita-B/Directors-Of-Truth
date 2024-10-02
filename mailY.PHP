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

	$fn=$_GET['fn'];
	$pdist=$_GET['pdist'];
	$ID=$_GET['IN'];
	//$table=$_GET['table'];

	/*echo $fn;
	echo $table;*/
	$msg = "";
    //$name_err=$username_err=$password_err=$msg="";
	if(isset($_GET['fn']))
	{	
            $result=mysqli_query($conn,"SELECT * FROM user_registration WHERE REG_ID='" . $fn . "'");
			
			//echo"hi";
            if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc())
				{
					$email=$row['EMAIL_ID'];

                	$mail=new PHPMailer(true);
					$mail->IsSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPAuth = true; 
					$mail->Username = "oindrilapathak2020@gmail.com";
					$mail->Password = "xzrpiqkyiowrdnzi";
					$mail->SMTPSecure = "ssl";  
					$mail->Port = "465";
					$mail->SMTPDebug = 2;

					$mail->setFrom('oindrilapathak2020@gmail.com');
					$mail->AddAddress($email);
					$mail->IsHTML(true);

					$mail->subject="no reply";
					$mail->Body    = 'ID Verification Result: No possible criminal history found. ID Verified successfully. Contact nearest police station for further information.';

					$mail->send();
					//echo"hi";
					$result=mysqli_query($conn,"UPDATE ID_VERIFICATION SET VERIFY_RESULT='COMPLETED' WHERE ID_NUMBER=$ID");
					echo 
					"
						<script> 
							alert('Sent Successfully'); 
							document.location.href='send1.html';
						</script>
					";
				}
			}
			else 
            {
                $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
            }
    }  
$conn->close();
?>