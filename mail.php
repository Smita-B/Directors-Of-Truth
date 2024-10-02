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
	//$table=$_GET['table'];

	/*echo $fn;
	echo $table;*/
	$msg = "";
    //$name_err=$username_err=$password_err=$msg="";
	if(isset($_GET['fn']))
	{	
            $result=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE M_ID='" . $_GET["fn"] . "'");
            if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc())
				{
					$mname=$row['M_NAME']; 
					$mgender=$row['GENDER'];
					$mage=$row['AGE'];
					$mfeature=$row['FEATURE'];
					$mlocation=$row['LOCATION'];
					$mpsname=$row['PSNAME'];
					$mdate=$row['DATE'];
					$PHOTO=$row['PHOTO'];
					$email=$row['EMAIL'];

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
					$mail->Body    = 'Request is accepted<br><b>Possible match found Details</b><br>
					Name: ' . $mname . '<br>
					Gender:' . $mgender . '<br>
					Age:' . $mage . '<br>
					Features:' . $mfeature . '<br>
					Found Location:' . $mlocation . '<br>
					Police Station Name:' . $mpsname . '<br>
					Found Date:' . $mdate . '<br>
					Photo:' . $PHOTO . '<br>
					';

					$mail->send();
					$result1=mysqli_query($conn,"UPDATE MISSING_REPORT SET STATUS = 'MATCH FOUND' WHERE M_ID = $fn  ");

					echo 
					"
						<script> 
							alert('Sent Successfully'); 
							document.location.href='sucess.html';
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