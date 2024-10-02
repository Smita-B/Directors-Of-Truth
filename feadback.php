<?php
include("config.php");
?>
<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    	$name=$_POST['n'];
    	$email=$_POST['e'];
    	$phone=$_POST['p'];
    	$message=$_POST['m'];

    	$result=mysqli_query($conn,"Insert into feedback(Name,Phone,Email,Message) values('$name','$phone','$email','$message')");
    	if($result)
            {
                header("location:feedbacksucess.html");
            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
    }
$conn->close();
?>
