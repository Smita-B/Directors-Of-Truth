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

$fn=$_GET['fn'];
$table=$_GET['table'];
?>
<!doctype html>
<html>
<head>
	<title></title>
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
</head>
<body>
<CENTER>
	<div class="card">
    <h1>Thank You</h1> 
<?php
echo "UserID: " . $fn;
echo "from " . $table . " record ";
if(isset($_GET['fn']))
{	
	$result=mysqli_query($conn,"DELETE FROM user_registration WHERE REG_ID ='" . $_GET["fn"] . "'");
		
		if($result)
		{
			echo "deleted successfully";
		}
    else 
    {
      echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
	
	<br><br>
	<a href="admin dashboard.php" ><input type="button" value="Back" class="button"><br></CENTER></a>
	<?php
	$conn->close();
	?>


</div>	
</body>
</html>

