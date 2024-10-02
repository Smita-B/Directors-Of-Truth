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
?>
<!doctype html>
<html>
<head>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Police Profile</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  font-family: 'Josefin Sans', sans-serif;
}

body{
   background-color: #f3f3f3;
}

.wrapper{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 320px;
  height: 480px;
  display: flex;
  box-shadow: 0 1px 20px 0 rgba(69,90,100,.08);
}

.wrapper .left{
  width: 100%;
  background: linear-gradient(to right,#6f1521,#aa3443,#44030b);
  padding: 30px 25px;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  text-align: center;
  color: #fff;
}

.wrapper .left img{
  border-radius: 5px;
  margin-bottom: 10px;
}

.wrapper .left h4{
  margin-bottom: 10px;
}

.wrapper .left p{
  font-size: 12px;
}

.open-button {
  background-color: #555;
  color: white;
  padding: 8px 18px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
  
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.button
{
    background-color: black;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 15px 15px;
    font-size: 15px;
    cursor: pointer;
}
    </style>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$err="";
			if(empty($_POST['ps'])    )
			{
			  $err="ERROR"; //error message
			}
			if($err=="ERROR")
			{
				 echo "	<br>	<br><CENTER>Please select a police station</CENTER>";
			}
		else{
		$PSNAME=$_POST['ps'];
    	$sql=mysqli_query($conn,"select * from police_record where PSNAME='$PSNAME'");
    	while($row=$sql->fetch_assoc())
    	{
        $Oincharge=$row["OIncharge"];
        $phone=$row["PHONE"];
        $add=$row["ADDRESS"];
        $photo=$row["PHOTO"];
        //$photo="Missing_images/534621-3.jpg";
        $pincode=$row["PINCODE"];
        //echo $photo;
    	}
		?>

		<div class="wrapper">
    	<div class="left">
        <img src="<?php echo $photo; ?>" width="200" height="200">
        <h3><?php echo $PSNAME ?> Police Station</h3><br><br>
        <h5>Officer In Charge</h5><p><?php echo $Oincharge ?></p><br>
        
            
            <div class="info_data">
                <div class="data">
                    <h4>Address</h4>
                    <p><?php echo $add ?></p>
                 </div>
            </div>
            <br>
            <div class="info_data">
              <div class="data">
                   <h4>Phone Number</h4>
                    <p><?php echo $phone; ?></p>
              </div>
            </div>
        
    	
    	
      <?php
		}
	}

	$conn->close();
	?>
	<br>		
	<a target="_ " href="front.php"><CENTER><input type="button" value="Back" class="button"><br><br></CENTER></a></div>
    <!--<?php echo $photo; ?>-->
</body>
</html>