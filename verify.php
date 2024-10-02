<?php
	include("config.php");
	session_start();

	$name=$_SESSION['name'];
	$Email=$_SESSION['email'];
    $Username=$_SESSION['username'];
    $Password=$_SESSION['password'];

	$code=$_SESSION['otp'];
	$otp_err="";
	if (isset($_POST['submit']))
    {
    	if(empty($_POST['otp']))
            $otp_err="Enter the verification code";
        else
            $otp=mysqli_real_escape_string($conn, $_POST['otp']);
        if(empty($otp_err))
        {
        	if ($code === $otp) 
            {
            	echo 
					"
						<script type = 'text/javascript'>  
            			function fun() 
            			{  
							alert('Congratulations, your account has been successfully created.'); 
							document.location.href='sign_in.php';
						}
						</script>
					";
            }
            else
            {
            	$otp_err= "Enter correct verification code";
            }
        }
        else
        {
        	$otp_err= "Please enter correct OTP";
        }
    }
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Verify</title>
	<link rel="stylesheet" type="text/css" href="sign.css">
	<link rel="stylesheet" type="text/css" href="verify.css">
	<style type="text/css">
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Baskerville Old Face', sans-serif;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(back2.jpg);
    background-size: cover;
}
.container{
    padding: 40px;
    border-radius: 20px;
    border: 8px solid  #35020d;
    box-shadow: -5px -5px 25px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    inset 5px 5px 15px rgba(0, 0, 0, 0.35);
}
.container .form{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 25px;
}
.container .form.signin,
.container.signinForm .form.signup{
    display: none;
}
.container.signinForm .form.signin{
    display: flex;
}
.container .form h2{
    color: white;
    font-weight: 500;
    letter-spacing: 0.1em;
}
.container .form .inputBox{
    position: relative;
    width: 300px;
}

.container .form .inputBox input{
    padding: 12px 10px 12px 48px;
    border: none;
    width: 100%;
    background: black;
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: white;
    font-weight: 300;
    border-radius: 25px;
    font-size: 1em;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35);
    transition: 0.5s;
    outline: none;
}
.container .form .buttonBox input{
    padding: 8px 8px 8px 38px;
    border: none;
    width: 100%;
    background: black;
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: white;
    font-weight: 300;
    border-radius: 25px;
    font-size: 1em;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35);
    transition: 0.5s;
    outline: none;
}
.container .form .inputBox span{
    position: absolute;
    left: 0;
    padding: 12px 10px 12px 48px;
    pointer-events: none;
    font-size: 1em;
    font-weight: 300;
    transition: 0.5s;
    letter-spacing: 0.05em;
    color: rgba(255, 255, 255, 0.5);
}
.container .form .inputBox input:valid ~ span,
.container .form .inputBox input:focus ~ span{
    color: red;
    border: 1px solid red;
    background: black;
    transform: translateX(25px) translateY(-7px);
    font-size: 0.6em;
    padding: 0 8px;
    border-radius: 10px;
    letter-spacing: 0.1em;
}
.container .form .inputBox input:valid,
.container .form .inputBox input:focus{
    border: 1px solid rgb(23, 21, 21);
}

.container .form .inputBox i{
    position: absolute;
    top: 15px;
    left: 16px;
    width: 25px;
    padding: 2px 0;
    padding-right: 8px;
    color: Red;
    border-right: 1px solid red;
}
.container .form .inputBox input[type="submit"]
{
    background: #133605;
    color: rgb(249, 244, 244);
    padding: 10px 0;
    font-weight: 500;
    cursor: pointer;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    inset 5px 5px 15px rgba(0, 0, 0, 0.35);
}
.container .form p{
    color: rgba(255, 255, 255, 0.5);
    font-size: 1em;
    font-weight: 300;
}
.container .form p a{
    font-weight: 700;
    color: white;
}

    </style>
</head>
<body>
	<div class="form" style="text-align: center;">
		<h2><font color="white">Verify Your Email Account</font></h2><br>
		<p><font color="yellow">We emailed you the digit otp code to enter the code below to confirm your email address..</font></p>
		<form action="" method="POST" autocomplete="on">
			<div class="fields-input">
				<input type="text" name="otp" class="otp_filed" placeholder="12345" required onpaste="false">
			</div>
			<div class="submit">
				<input type="submit" name="submit" value="verify Now" class="button"  onclick = "fun();" />
			</div>
			<?php
				echo "<font color='yellow>" . $otp_err . "</font>";
			?>
		</form>
	</div>
	
</body>
</html>