<?php
$servername="localhost";
$username="root";
$password="";
$dbname="POLICE";

$conn=new mysqli($servername,$username,$password,$dbname);
session_start();
if($conn->connect_error)
{
	die("connection failed".$conn->connect_error);
}

$row["M_ID"]=$_SESSION['mid'];
$M_ID=$row["M_ID"];
$REG_ID=$_SESSION['REG_ID'];
$_SESSION['REG_ID']=$REG_ID;

?>
<!doctype html>
<html>
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
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
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
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
<body>
<CENTER>
	<div class="card">
		<h1>Thank You</h1> 
<?php
//echo $fn;
//echo $table;
//if($_SERVER["REQUEST_METHOD"] == "POST")
//{
		
  $result1=mysqli_query($conn,"SELECT * FROM USER_REGISTRATION WHERE REG_ID = $REG_ID  ");
  $row = mysqli_fetch_assoc($result1);
  $EMAIL=$row["EMAIL_ID"];

	$result=mysqli_query($conn,"UPDATE MISSING_REPORT SET STATUS = 'POSSIBLE MATCH FOUND', EMAIL='$EMAIL' WHERE M_ID = $M_ID  ");
		
		if($result)
		{
			echo "<p>Your Request is sent sucessfully;<br/> we'll be in touch shortly!</p>";
		}
//}

?>
	
	<br><br>
	<a href="menu.php" ><input type="button" value="Back" class="button"><br><br></CENTER></a>
	<?php
	$conn->close();
	?>


</form>	
</body>
</html>

