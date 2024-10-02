<?php
$servername="localhost";
$username="root";
$password="";
$dbname="POLICE";

$conn=new mysqli($servername,$username,$password,$dbname);
session_start();
$PSNAME=$_SESSION['PSNAME'];
$pid=$_SESSION['pid'];
$OC=$_GET['OC'];
$PH=$_GET['PH'];
//echo $PSNAME;
if($conn->connect_error)
{
	die("connection failed".$conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_POST['Name'];
    $phone=$_POST['Phone'];

    $upload_dir="POLICE_PHOTO/";
        $allowed_types = array('jpg', 'jpeg');
            // Checks if user sent an empty form
            $ERROR=1;
            if(!empty(array_filter($_FILES['upload']['name']))) 
            {
                
                $ERROR=0;
                // Loop through each file in files[] array
             foreach ($_FILES['upload']['tmp_name'] as $key => $value) 
             {
             
            $file_tmpname = $_FILES['upload']['tmp_name'][$key];
            $file_name = $_FILES['upload']['name'][$key];
            
            $file_size = $_FILES['upload']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $n_name=$upload_dir.$pid.".".$file_ext;
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
                        $ERROR=1;
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        rename($filepath,$n_name);
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                        $ERROR=1;
                    }
                }
            }
            else {
                 
                // If file extension not valid
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
                $ERROR=1;
            }
        }
    }  
    if($ERROR==0)
    {
        $result = "UPDATE police_record SET OIncharge='$name',PHONE='$phone',PHOTO='$n_name' WHERE P_id=$pid";
    }
    else
    {
        $result = "UPDATE police_record SET OIncharge='$name',PHONE='$phone' WHERE P_id=$pid";
    }
    
            if ($conn->query($result) === TRUE) 
            {
                header('location: policeupdate.php');
            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            } 
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Login & Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sign.css">
    <style>
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
        .container .form .message{
    position: relative;
    width: 300px;
    color: yellow;
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
        <form action=" " method="POST" enctype="multipart/form-data">
        <div class="form signup">
            <h2><?php echo $PSNAME; ?> Police Station</h2>
            <div class="inputBox">
                <input type="text" required="required" name="Name" value="<?php echo $OC ?>">
                <i class="fa-solid fa-file-signature"></i>
                <span>Officer Incharge Name</span>
            </div>
            <div class="inputBox">
                <input type="file" name="upload[]" value="" / multiple>
                <i class="fa-solid fa-image-portrait"></i>
                <span>Officer Incharge Photo</span>
            </div> 
            <div class="inputBox">
                <input type="text" required="required" name="Phone" id="email" value="<?php echo $PH ?>">
                <i class="fa-solid fa-phone"></i>
                <span>Phone Number</span>
            </div>
            <div class="inputBox">
                <div>
                    <input type="submit" class="btnSubmit" name="send">
                </div>
            </div>
        </div>
        <br>
        <!--<a target="_ " href="ShowPolice.php"><CENTER><input type="button" value="Back" class="button"></a> -->
        <a target="_ " href="ShowPoliceSubmitted.php?ps=<?php echo $PSNAME ?>"><CENTER><input type="button" value="Back" class="button"></a>
        </form>
    </div>
</body>
</html>
