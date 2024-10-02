<?php
$servername="localhost";
$username="root";
$password="";
$dbname="POLICE";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
session_start();
$REG_ID=$_SESSION['REG_ID'];
//$NAME=$_SESSION['NAME'];                  
$result=mysqli_query($conn,"select * from user_registration where REG_ID=$REG_ID");
    if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$Gurdian=$row['GUARDIAN_NAME'];
				$age=$row["AGE"];
			}
		}
//$_SESSION['NAME']=$NAME;
$_SESSION['REG_ID']=$REG_ID;
$_SESSION['AGE']=$age;
$_SESSION['Guardian']=$Gurdian;
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complaints Type</title>
	<link rel="stylesheet" type="text/css" href="menu.css">
	<style type="text/css">
		.button {
        background-color: #410613;
        border: none;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
      }
	</style>
</head>
<body>
	<a href="front.php" ><input type="button" value="Back" class="button"></a>
	<div class="wrapper">
		<div class="card">
			<img src="FIR.jpeg">
			<div class="info">
				<h1>FIR</h1>
				<p>Something about FIR</p>
				<a href="FIR_REPORT.php" class="btn">Lodge FIR</a>
			</div>
		</div>
		<div class="card">
			<img src="gds.jpg">
			<div class="info">
				<h1>GD</h1>
				<p>Something about GD</p>
				<a href="GD form.php" class="btn">Lodge GD</a>
			</div>
		</div>
		<div class="card">
			<img src="missing.jpg">
			<div class="info">
				<h1>MISSING DIARY</h1>
				<p>Something about MISSING DIARY</p>
				<a href="missing.php" class="btn">Lodge Missing Diary</a>
			</div>
		</div>
	</div>
</body>
</html>