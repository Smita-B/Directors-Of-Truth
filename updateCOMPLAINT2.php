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

//echo $fn;
//echo $table;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
		$status=$_POST['status'];
		if ($table=="FIR_DETAILS" || $table=="GD_DETAILS")
			$result=mysqli_query($conn,"UPDATE COMPLAINT_STATUS SET STATUS = '$status' WHERE COMPLAINT_NO = $fn AND COMPLAINT_TYPE= '$table' ");
		if ($table=="MISSING_REPORT")
		{
			$result=mysqli_query($conn,"UPDATE MISSING_REPORT SET STATUS = '$status' WHERE M_ID = $fn  ");
			if ($status=="MATCH FOUND")
			{
				//echo "match found ";
				$character = "-";
				$position = strpos($PHOTONAME, $character);
    			$position=$position+1;
				//echo "\npos".$position;
				
				$LEN = substr($PHOTONAME,$position,1);
				$file_ext = substr($PHOTONAME,$position+1,);
				//echo "\nlen".$LEN;
				$folder = 'Missing_images/';
                
				//echo $newImage;

				$i=1;
				while($i<=$LEN)
				{
					$fn1=rtrim($fn, " ");
					$newImage =$fn1."-".$i.$file_ext;
					$filePath = 'Missing_images/'.$newImage ;
					echo $filePath;
					$destinationFilePath = 'MATCHED_PIC/'.$newImage;
					rename($filePath, $destinationFilePath);
					echo"<br>";
					$i=$i+1;
				}
    			

			}
		}
			
		
		if($result)
		{
			header("location:adminpop.html");
		}
}

?>


		
<!doctype html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="sign.css">
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
</head>
<body>
	<div class="container">
	<form action='' method="POST">
		<div class="form signup">
	<CENTER>
	<!-- DROPDOWN FOR SELECTING THE ATTRIBUTE BY WHICH WANT TO FETCH COMPLAINTS-->	
	<?php
	if ($table=="FIR_DETAILS")
	{
		?>
		<table ><tr>
		<td id="text" class="txt" > <h2>Choose Status<br></h2> </td></tr>
		<tr><td>:<select  name="status"  size="1" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;"><br>
    	<option value selected="selected">------------Select------------</option>
		<option value="ACTIVE">ACTIVE</option>
    	<option value="SOLVED">SOLVED</option>
    	<option value="DISMISSED">DISMISSED</option>
    
  		</select></td></tr>
		</table >
  		<br><br>
		<?php
	}
	?>
	<?php
	if ($table=="GD_DETAILS")
	{
		?>
		<table ><tr>
		<td id="text" class="txt" ><h2>Choose Status</h2></td></tr><tr><td>:<select  name="status"  size="1" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;"><br>
    	<option value selected="selected">------------Select------------</option>
		<option value="ACTIVE">ACTIVE</option>
    	<option value="SOLVED">SOLVED</option>
    
  		</select></td></tr>
		</table >
  		<br><br>
		<?php
	}
	?>

<?php
	if ($table=="MISSING_REPORT")
	{
		?>
		<table ><tr>
		<td id="text" class="txt" > <h2>Choose Status</h2> </td></tr><tr><td>:<select  name="status"  size="1" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;"><br>
    	<option value selected="selected">------------Select------------</option>
		<option value="ACTIVE">ACTIVE</option>
    	<option value="MATCH FOUND">MATCH FOUND</option>
    	<option value="DISMISSED">DISMISSED</option>
    
  		</select></td></tr>
		</table >
  		<br><br>
		<?php
	}
	?>
	<div class="inputBox">
	<input type="submit" name="submit" value="Submit">
	</div><br><br>
	<a href="ViewComplaints.php?attribute=ERROR" ><input type="button" value="Back" class="button" style="cursor: pointer; text-align: center;"></div></CENTER></a>
	
	<?php
	$conn->close();
	?>

</CENTER></div>
</form>	
</div>
</body>
</html>

