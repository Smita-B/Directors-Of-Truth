<?php
	include("config.php");
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Face Recognition</title>
		<!-- CSS style to put div side by side -->
		<link rel="stylesheet" type="text/css" href="sign.css">
		<style type="text/css">
		body{
    background: -webkit-linear-gradient(left,#70090e,#70090e,#000,#70090e,#70090e);
}
		.container {
			width:800px;
			height:400px;
			padding-top:20px;
			padding-left:15px;
			padding-right:15px;
		}
		#st-box {
			float:left;
			width:300px;
			height:350px;
			background-color:white;
			border:solid black;
		}
		#rd-box {
			float:right;
			width:300px;
			height:350px;
			background-color:white;
			border:solid black;
		}
		.button {
background-color: #4CAF50; /* Green */
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
}
		h1 {
			color:white;
		}
		th{
			padding-left: 30px;
		}
		td{
			padding-left: 15px;
		}
		.block
		{
		width: 240px;
        height: 340px;
        box-shadow: 5px 5px 5px 5px white;

		}
		</style>
	</head>
	
	<body>
		<form action="sendRequest.php" method="POST">
		<center>
		<h1>Face Recognition Output</h1>
		<?php
			$output= $_SESSION['output'];
			$seekername=$_SESSION['name'];
			$path=$_SESSION['photo'];
			$words = explode(" ", $output);
			$session = $words[0];
			$rest = implode(" ", array_slice($words, 1));
			$rest1 = implode(" ", array_slice($words, 9));
			$_SESSION['rest'] = $rest;
			$_SESSION['rest1'] = $rest1;
			echo '<br><table>';
			echo "<tr>
			<td><img src='$path' height='341' width='256' alt=$path><td>";
			
			
			//echo $mid;
			//$sql = "SELECT Name FROM MATCHFOUND WHERE Session='$session' AND GFrom='$seekername'";
			$sql = "SELECT * FROM MATCHFOUND WHERE Session='$session'";
			$result = mysqli_query($conn, $sql);
			$count=mysqli_num_rows($result);
			if ($count > 0) 
			{

  			// Output data of each row
  				while($row = mysqli_fetch_assoc($result)) {
					$_SESSION['mid']=$row["M_ID"];
					$mid=$row["M_ID"];
					$sql1 = "SELECT * FROM MISSING_REPORT WHERE M_ID=$mid";
					$result1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_fetch_assoc($result1);
					$pathfound=$row1['PHOTO'];
					echo "<td> <font size='5px' color='yellow' face='Times New Roman'><b>MATCH FOUND</b></font></td>";
					//$pathfound='Missing_images/'.$row["M_ID"].'-1.jpg';
    				echo "<td><img src='$pathfound' alt=$pathfound height='341' width='256'></td></tr>";
    				echo "</table>";
					echo "<br>";echo "<br>";
					echo "<font size='3px' color='white' face='Times New Roman'><b>" . $rest . "</b></font><br><br><br><br><br>";
					/*echo "<a class='button' href='mailM.php?fn=<?php echo $mid ?> & res=<?php echo $rest ?> & table=missing_report'>
					<CENTER>Send Request</CENTER> </a>";*/
					echo "<a class='button' href='mailM.php?fn=<?php echo $mid ?> & table=missing_report'>
				<CENTER>Send Mail</CENTER></a>";
  				}
			} 
			else {
  				echo "</table><br><font size='5px' color='yellow' face='Times New Roman'><b>NO MATCH FOUND</b></font>";
				  echo "<br><br><br><br><a class='button' href='found_form.php'>
				  <CENTER>Lodge Report</CENTER>
					</a>";
				}
			mysqli_close($conn);
		?>
	</form>
	</body>
</html>				
