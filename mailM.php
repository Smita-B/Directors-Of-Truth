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

	$fn=$_SESSION['mid'];
    $rest=$_SESSION['rest'];
	$rest1=$_SESSION['rest1'];
	//$pdist=$_GET['pdist'];
	//$ID=$_GET['IN'];
	//$table=$_GET['table'];

	/*echo $fn;
	echo $table;*/
	$msg = "";
    //$name_err=$username_err=$password_err=$msg="";
	if(isset($_GET['fn']))
	{	
            $result=mysqli_query($conn,"SELECT * FROM missing_report WHERE M_ID='" . $fn . "'");
            //$result=mysqli_query($conn,"SELECT * FROM missing_report WHERE M_ID=23821254");
            $row = $result->fetch_assoc();
            $regid=$row['REG_ID'];
			$result=mysqli_query($conn,"SELECT * FROM user_registration WHERE REG_ID='" . $regid . "'");
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

					//$mail->subject="no reply";
                    $mail->subject="Match Found";
					/*$mail->Body    = 'ID Verification Result: Matched '.$pdist.'% with a possible criminal. Contact nearest police station for further information.
					';*/
                    //$fn=23821254;
                	$mail->Body    = "Closest match found with accuracy ".$rest1." for your missing search. For further details contact nearest police station";
					//$mail->Body    = $rest;
					$mail->send();
					//echo"hi";
                    //$fn=23821254;
					//$result=mysqli_query($conn,"UPDATE MISSING_REPORT SET STATUS='MATCH FOUND' WHERE M_ID=$fn");
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