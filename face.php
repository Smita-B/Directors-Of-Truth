<?php
	include("config.php");
	session_start();
	$REG_ID=$_SESSION['REG_ID'];
$_SESSION['REG_ID']=$REG_ID;

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
			echo '<br><table>';
			echo "<tr>
			<td><img src='$path' height='341' width='256' alt=$path>";
			
			
			//echo $mid;
			//$sql = "SELECT Name FROM MATCHFOUND WHERE Session='$session' AND GFrom='$seekername'";
			$sql = "SELECT * FROM MATCHFOUND WHERE Session='$session'";
			$result = mysqli_query($conn, $sql);
			$count=mysqli_num_rows($result);
			if ($count > 0) 
			{

  			// Output data of each row
  				while($row = mysqli_fetch_assoc($result)) 
				{
					$_SESSION['mid']=$row["M_ID"];
					$mid=$row["M_ID"];
					echo "<td> <font size='5px' color='green' face='Times New Roman'><b>MATCH FOUND</b></font></td>";
					$pathfound='faces/'.$row["M_ID"].'-1.jpg';
    				echo "<td><img src='$pathfound' alt=$pathfound height='341' width='256'></td></tr>";
    				echo "</table>";
					echo "<br>";echo "<br>";
					echo "<font size='3px' color='white' face='Times New Roman'><b>" . $rest . "</b></font><br><br><br><br><br>";
					
				echo "<a class='button' href='sendRequest.php?fn=<?php echo $mid ?> & table=missing_report'>
				<CENTER>Send Request</CENTER></a>";
        		
  				}
			} 
			else {
				//echo "<td> <font size='5px' color='green' face='Times New Roman'><b>NO MATCH FOUND</b></font></td>";
				/*echo "<div class='inputBox'>
                <div>
                    <input type='submit' value='Missing report' name='request' class='button'>
                </div>
            </div>";*/
					echo "</table><br><font size='5px' color='yellow' face='Times New Roman'><b>NO MATCH FOUND</b></font>:";
					echo "<br><br><br><br><a class='button' href='miss_form.php'>
					<CENTER>Lodge Report</CENTER>
			  		</a>";
				}
			mysqli_close($conn);
		?>
	</form>
		</center>
	</body>
</html>				
