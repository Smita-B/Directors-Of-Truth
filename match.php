<?php
	include("config.php");
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Face Recognition</title>
		<!-- CSS style to put div side by side -->
		<style type="text/css">
    body {
        text-align: center;
        padding: 40px 0;
        background: white;
      }
        h3 {
          color: #222;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 25px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: #6d5656;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 10px 10px black;
        display: inline-block;
        margin: 0 auto;
      }
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
		<form action="" method="POST">
		<center>
		<div class="card">
		<h3>Identity Verification</h3>
		<br><br>
		<?php
			$output= $_SESSION['output'];
			$seekername=$_SESSION['name'];
			$path=$_SESSION['photo'];
			//echo $seekername;
			$words = explode(" ", $output);
			//echo $words[0];
			//$session = $words[0];
			$rest = implode(" ", array_slice($words, 1));
			
			$sql = "SELECT * FROM id_verification WHERE NAME='$seekername' and VERIFY_RESULT='Matched' ";
			$result = mysqli_query($conn, $sql);
			$count=mysqli_num_rows($result);
			if ($count > 0) 
			{

  			// Output data of each row
  				while($row = $result->fetch_assoc())
					{
							$_SESSION['ID_NUMBER']=$row["ID_NUMBER"];
							$REG_ID=$row["REG_ID"];
							$pdist=$row["PMATCH"];
							echo "<font size='6px' color='yellow' face='Times New Roman'><b>Request is being processed.. Click to confirm</b></font><br><br><br>";
							?>
							<a class='button' href='mail.html?fn=<?php echo $REG_ID ?> & pdist=<?php echo $pdist ?> & table=id_verification'>
							<CENTER>Confirm</CENTER>
          					</a>
							<?php
  				}
  			} 
			else 
			{
				$sql = "SELECT * FROM id_verification WHERE NAME='$seekername' ";
				$result = mysqli_query($conn, $sql);
				$row = $result->fetch_assoc();
  				echo "<font size='5px' color='yellow' face='Times New Roman'><b>Request is being processed.. Click to confirm</b></font><br>";
  				echo "<a class='button' href='mail.html?fn=" . $row['ID_NUMBER'] . " & table=id_verification'>
			<CENTER>Confirm</CENTER>
          	</a>";
			}
			mysqli_close($conn);
			?>
			
			<br><br>
		</div>
		</center>
		</form>
	</body>
</html>				
