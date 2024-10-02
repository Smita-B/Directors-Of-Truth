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
/*$id=$_SESSION['id'];
$name=$_SESSION['name'];                  
$photoname=$_SESSION['photo'];*/
    
    //post method to pass variables from html code to php in a page
    //post method to pass variables from html code to php in a page
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $reg_id=$_SESSION['REG_ID'];
        $id=rand(100000,100000000);
        $name=$_POST['n1'];
        $age=$_POST['n3'];
        $relation=$_POST['n4'];
        $mobile=$_POST['n5'];
        $email=$_POST['n7'];
        $gender=$_POST['n6'];
        $location= $_POST["n8"];
        $date= $_POST["n9"];
        $time= $_POST["n19"];
        $psname= $_POST["ps"];
        $feature= $_POST["feature"];
        
       
      
        $upload_dir="Missing_images/";
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
            $key=$key+1;
            $n_name=$upload_dir.$id."-".$key.".".$file_ext;
            // Set upload file path
            $filepath = $upload_dir.$file_name;
 
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {
 
                
                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if(file_exists($filepath)) 
        {
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        //echo "{$file_name} successfully uploaded <br />";
                        rename($filepath,$n_name);
              

                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        //echo "{$file_name} successfully uploaded <br />";
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
            $result=mysqli_query($conn,"INSERT INTO MISSING_REPORT(REG_ID,M_ID,M_NAME,Category,PHOTO,GENDER,AGE,FEATURE,RELATION,EMAIL,MOBILE,DATE,TIME,PSNAME,LOCATION) 
            values('$reg_id','$id','$name','LOST','$n_name','$gender','$age','$feature','$relation','$email','$mobile','$date','$time','$psname','$location')");
            if($result)
            {
                echo " ";
            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
		    echo"<html>";
			 echo "<link rel='stylesheet' type='text/css' href='GD.css'>";
			 echo "<style>
			 body {
			   text-align: center;
			   padding: 40px 0;
			   background: #EBF0F5;
			 }
			   h1 {
				 color: #88B04B;
				 font-family: 'Nunito Sans', 'Helvetica Neue', sans-serif;
				 font-weight: 900;
				 font-size: 40px;
				 margin-bottom: 10px;
			   }
			   p {
				 color: #404F5E;
				 font-family: 'Nunito Sans', 'Helvetica Neue', sans-serif;
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
			   margin: 4px 4px;
			   cursor: pointer;
			 }
		   </style>
		";
			 //echo"<html>";
			 echo"<body bgcolor='beige'>";
			 //echo"<p><font size='20' >";
             echo"<div class='card'>";
			 echo "<h1> MISSING REPORT for Registration no: ".$reg_id." is submitted successfully.<h1>";
			 echo " <p>Note down the MISSING REPORT No:".$id." for future reference.</p><br>";
             echo "<form action='menu.php' method='POST'> <button class='button' id='submit' type='submit'>Menu</button></form></div>";
        		
        		

    }
$conn->close();

?>