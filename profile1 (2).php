<?php
    include("config.php");
    session_start();
    $REG_ID=$_SESSION['REG_ID'];
    $sql=mysqli_query($conn,"select * from user_registration where REG_ID=$REG_ID");
    while($row=$sql->fetch_assoc())
    {
        $Name=$row["NAME"];
        $Email=$row["EMAIL_ID"];
        $phone=$row["PHONE"];
        $username=$row["USERNAME"];
        $gn=$row["GUARDIAN_NAME"];
        $age=$row["AGE"];
        $gender=$row["GENDER"];
        $add=$row["ADDRESS"];
        $Ptype=$row["PHOTOID_TYPE"];
        $photo=$row["PHOTO"];
        $Pno=$row["PHOTOID_NO"];
        //echo $photo;
        //$_SESSION['username']=$username;
    }
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSS User Profile Card</title>
    <link rel="stylesheet" href="css/profile.css">
    <style type="text/css">
        .open-button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 8px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.open-button {
  background-color: #222;
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
  background-color: #570308;
  color: white;
  padding: 10px 15px;
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
.Submit{
    font-size: 15px;
    padding: 10px 10px;
    background-color: #570308;
    border: none;
    color: white;
    cursor: pointer;
}
.button
{
    background-color: black;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 15px 15px;
    font-size: 15px;
}

    </style>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="left">
        <img src="<?php echo $photo; ?>" width="200" height="200">
        <h3>Personal Information</h3><br><br>
        <h5>Name: <?php echo $Name ?></h5><br>
        <h5>Gender: <?php echo $gender ?></h5><br>
        <h5>Age: <?php echo $age ?></h5><br>
        <h5>Guardian Name: <?php echo $gn ?></h5>
    </div>
    <div class="right">
        <div class="info">
            <h3>Contact Information</h3>
            <div class="info_data">
                <div class="data">
                    <h4>Address</h4>
                    <p><?php echo $add ?></p>
                 </div>
            </div>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p><?php echo $Email ?></p>
                 </div>
            </div>
            <div class="info_data">
              <div class="data">
                   <h4>Phone Number</h4>
                    <p><?php echo $phone; ?></p>
              </div>
            </div>
        </div>
      
      <div class="info">
            <h3>Information Details</h3><br>
            <div class="projects_data">
                 <div class="data">
                    <h4>Photo ID type</h4>
                    <p><?php echo $Ptype; ?></p>
                 </div>
            </div>
            <div class="projects_data">
                 <div class="data">
                   <h4>Photo ID Number</h4>
                    <p><?php echo $Pno; ?></p>
                </div>
            </div>
        </div>
        <form action="UserComplaintUPDATE1.php" method="POST">
                <center><input class="Submit" type="submit" value="Show Complaints"></center>
        </form>
        </div>
</div><br>
    <a target="_ " href="front.php"><CENTER><input type="button" value="Back" class="button" style="cursor: pointer;"><br><br></CENTER></a></div>

    </center>
      </div>
    </div>
</div>

</body>
</html>
