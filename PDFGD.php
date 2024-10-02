<?php
$servername="localhost";
$username="root";
$password="";
$dbname="POLICE";
session_start();
$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
	die("connection failed".$conn->connect_error);
}

$AGE=$_SESSION['AGE'];
$FATHER=$_SESSION['Guardian'];

$_SESSION['AGE']=$AGE;
$_SESSION['FATHER']=$FATHER;

require_once __DIR__ . '/vendor/autoload.php';


$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);


if($_SERVER["REQUEST_METHOD"]=="POST")
{
$html='<!DOCTYPE html>
<html>
<head>
	<title>GD Letter</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
css
Copy code
	header {
		background-color: #ccc;
		padding: 20px;
		text-align: center;
	}

	section {
		padding: 20px;
		line-height: 1.5;
	}

	footer {
		background-color: #ccc;
		padding: 20px;
		text-align: center;
	}
</style>
</head>
<body>';
$PSNAME=$_SESSION['psname'];
$result=mysqli_query($conn,"SELECT PINCODE FROM POLICE_RECORD WHERE PSNAME='$PSNAME'");
$row = $result->fetch_assoc();  
$PIN=$row['PINCODE'];		
$html .='<header>
		<h1>GD Entry No: '.$_SESSION['gdno'].'</h1>
		<p>To,</p>
		<p>The Officer-in-Charge</p>
		<p><b><i>'.$_SESSION['psname'].'</i></b> P.S.</p>
		<p>KOLKATA-<b><i>'.$PIN.'</i></b></p>
		
	</header>';
//$REG_ID=$_SESSION['reg_id'];
$REG_ID=$_SESSION['REG_ID'];
$result=mysqli_query($conn,"SELECT NAME FROM USER_REGISTRATION WHERE REG_ID='$REG_ID'");
$row = $result->fetch_assoc();  
$NAME=$row['NAME'];

$result=mysqli_query($conn,"SELECT ADDRESS FROM USER_REGISTRATION WHERE REG_ID='$REG_ID'");
$row = $result->fetch_assoc();  
$ADDRESS=$row['ADDRESS'];	

$result=mysqli_query($conn,"SELECT AGE FROM USER_REGISTRATION WHERE REG_ID='$REG_ID'");
$row = $result->fetch_assoc();  
$AGE=$row['AGE'];

$result=mysqli_query($conn,"SELECT GUARDIAN_NAME FROM USER_REGISTRATION WHERE REG_ID='$REG_ID'");
$row = $result->fetch_assoc();  
$FATHER=$row['GUARDIAN_NAME'];	

$html .='<section>
		<p>Sub:- Missing of <b><u><i>'.$_SESSION['ObjectName'].' </i></b></u></p>
		
		<p>Sir,</p>
		<p>Most respectfully,I hereby beg to state that my name is <b><u><i>'.$NAME.'</i></u></b> age <b><u><i>'.$AGE .'</i></u></b> years
		, s/o ,w/o ,d/o of <b><u><i>'.$FATHER.'</i></u></b> residing at <b><u><i>'.$ADDRESS.'</i></u></b> </p>
		<p>On <b><u><i>'.$_SESSION['datetime'].'</i></u></b> my <b><u><i>'.$_SESSION['ObjectName'].'</i></u></b> was lost from <b><u><i>'.$_SESSION['location'].'.</i></u></b></p>
		<p>Missing object details are as follows : <br> <b><u><i>'.$_SESSION['odetails'].'</i></u></b></p>
		<p>So, I earnestly request you to kindly lodge a General Diary regarding the above for this act of kindness and oblige me.</p>
		
		
		<p>Contact no :<b><u><i>'.$_SESSION['mobile'].'</i></u></b></p>';

$html .='<p>DATE: <b><u><i>'.date("d/m/Y").'</i></u></b></p>';


$html .='<p><img src="'.$_SESSION["sign_name"].'" height="50" width="90" alt=$pathfound></p>';

$html .='<p>'.$NAME.'</p>';
$html .='<p><b><u><i>NAME AND SIGNATURE</i></b></u></p>
	</section>
	<footer>
		<p>D.O.T &copy; 2023</p>
	</footer>
</body>
</html>';

$mpdf->WriteHTML($html);


$mpdf->Output();
}
?>