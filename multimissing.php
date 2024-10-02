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
$NAME=$_SESSION['NAME'];                  
/*$photoname=$_SESSION['photo'];*/
    
    //post method to pass variables from html code to php in a page
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
             $age=$_POST['n3'];
             $Guardian=$_POST['n4'];
            $mobile=$_POST['n5'];
             $gender=$_POST['n6'];
             $location= $_POST["n8"];
             $ID_proof= $_POST["n9"];
             $ID_no= $_POST["n2"];
        
            $_SESSION['NAME']=$NAME;
            $_SESSION['age']=$age;
            $_SESSION['Guardian']=$Guardian;
            $upload_dir="userphoto/";
            $allowed_types = array('jpg', 'jpeg');
            // Checks if user sent an empty form
            if(!empty(array_filter($_FILES['upload']['name']))) 
            {
 
                // Loop through each file in files[] array
             foreach ($_FILES['upload']['tmp_name'] as $key => $value) 
             {
             
            $file_tmpname = $_FILES['upload']['tmp_name'][$key];
            $file_name = $_FILES['upload']['name'][$key];
            
            $file_size = $_FILES['upload']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $n_name=$upload_dir. $NAME . "-".$key.".".$file_ext;
            // Set upload file path
            $filepath = $upload_dir.$file_name;
            if(in_array(strtolower($file_ext), $allowed_types)) {
                if(file_exists($filepath)) 
                {
                    $filepath = $upload_dir.time().$file_name;
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        rename($filepath,$n_name);
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        rename($filepath,$n_name);
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
            }
            else {
                 
                // If file extension not valid
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }   
             //insert records into Record table
           $result = "UPDATE user_registration SET PHONE='$mobile',GUARDIAN_NAME='$Guardian',AGE='$age',GENDER='$gender',ADDRESS='$location',PHOTOID_TYPE='$ID_proof',PHOTO='$n_name',PHOTOID_NO='$ID_no' WHERE REG_ID=$REG_ID";
            if ($conn->query($result) === TRUE) 
            {
                header('location: done.php');
            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
    }
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="multi.css">
    <style type="text/css">
        .container{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background-color:#bbb;
}
.container .card .right-side{
    width:85%;
    background-color:#fff;
    height:100%;
  border-radius:20px;
}
    </style>
</head>
<body>
    <!-- MultiStep Form -->
<div class="container">
    <div class="card">
        <div class="form">
            <div class="left-side">
                <div class="left-heading">
                    <h3>Registration</h3>
                </div>
                <div class="steps-content">
                    <h3>Step <span class="step-number">1</span></h3>
                    <p class="step-number-content active">Enter your personal information to get closer to make complaints.</p>
                    <p class="step-number-content d-none">Residential Information fill up.</p>
                    <p class="step-number-content d-none">Identity Information fill up.</p>
                    <p class="step-number-content d-none">Successful message</p>
                </div>
                <ul class="progress-bar">
                    <li class="active">Personal Information</li>
                    <li>Residential Information</li>
                    <li>Identity Proof</li>
                    <li>Done</li>
                </ul>  
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
            <div class="right-side">
                <div class="main active">
                    <div class="text">
                        <h2>Your Personal Information</h2>
                        <p><font color="green">Enter your personal information to get closer to make complaints.</font></p>
                    </div>
                    <div class="input-text">

                        <div class="input-div">
                            <input type="text" name="n4" id="t1"   maxlength="100" size="40" minlength="2" title="Enter name"  required style="width:320px">
                            <span><font color="black">Guardian Name</font></span>
                        </div>
                        
                    </div>
                    <div class="input-text">
                        <div class="input-div">
                            <input type="text" pattern="[+]{1}[0-9]{2}[0-9]{5}[0-9]{5}" name="n5" maxlength="13" minlength="13"id="t5" size="30" title="Enter your mobile no." required style="width:320px">
                            <span><font color="black">Phone No</font></span>
                        </div>
                    </div>
                    <div class="input-text">
                        <div class="input-div">
                            <input type="text" name="n3" id="t3" maxlength="100" minlength="1" size="5"title="Enter age here" required style="width:150px">
                            <span><font color="black">Age</font></span>
                        </div>
                        <div class="input-div">
                            
                            <select name="n6" style="width: 150px;">
                                <option>Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="buttons">
                        <button class="next_button">Next Step</button>
                    </div>
                </div>
                <div class="main">
                    <div class="text">
                        <h2>Residential Information</h2>
                        <p>Inform admins about your residence.</p>
                    </div>
                    <div class="input-text">
                        <div class="input-div">
                            <input type="text" name="n8" id="t8" maxlength="100" minlength="1" size="40" title="Enter address here" required>
                            <span>Address</span>
                        </div>
                        <div class="input-div"> 
                            <input type="text" required>
                            <span>Pincode</span>
                        </div>
                    </div>
                    
                    
                    <div class="buttons button_space">
                        <button class="back_button">Back</button>
                        <button class="next_button">Next Step</button>
                    </div>
                </div>
                <div class="main">
                    <small><i class="fa fa-smile-o"></i></small>
                    <div class="text">
                        <h2>Identity Proof</h2>
                        <p>Upload all necessary documents</p>
                    </div>
                    <div class="input-text">
                        <div class="input-div">
                            <select name="n9">
                            <option>Select your identity proof</option>
                <option value="Adhar Card">Adhar Card</option>
                <option value="Pan Card">Pan Card</option>
                <option value="Voter Card">Voter Card</option>
                <option value="Birth Certificate">Birth Certificate</option>
                <option value="Driving License">Driving License</option>
                </select> 
                        </div>
                        <div class="input-div"> 
                            <input type="text" required require name="n2">
                            <span>Photo ID number</span>
                        </div>
                    </div>
                    <div class="input-text">
                        <div class="input-div">
                        Upload your photo:<br>
                            <input type="file" name="upload[]" multiple id="Upload" accept="image/png, image/gif, image/jpeg" required>
                <i class="fa-solid fa-file-signature"></i>
                        </div>
                    </div>
                
                        <div class="buttons button_space">
                        <center><input type="submit" value="Submit "name="submit"></center>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="multi.js"></script>
</body>
</html>