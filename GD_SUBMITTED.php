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

    
    //post method to pass variables from html code to php in a page
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
			 
        	 //post method to pass variables from html code to php in a page
			
 		 $REG_ID=$_SESSION['REG_ID'];
		 $gdNo=rand(100000,100000000);
		 $ObjectName=$_POST['object'];
        	 $odetails=$_POST['odetails'];
            $mobile=$_POST['mobile'];
        	 $email=$_POST['email'];
        	 $location= $_POST['location'];
            $datetime= $_POST['dates'];
		 $psname=$_POST['ps'];
		 $NAME=$_SESSION['NAME'];

		// INITIALIZING SESSION VARIABLES
			 $AGE=$_SESSION['AGE'];
			 $FATHER=$_SESSION['Guardian'];

			 $_SESSION['AGE']=$AGE;
			 $_SESSION['Guardian']=$FATHER;
			 $_SESSION['gdno']=$gdNo;
            	 	// $_SESSION['reg_id']=2021;//for now taking constant
			 $_SESSION['ObjectName']=$ObjectName;
			 $_SESSION['odetails']=$odetails;
			 $_SESSION['mobile']=$mobile;
			 $_SESSION['email']=$email;
			 $_SESSION['location']=$location;
			 $_SESSION['datetime']=$datetime;
			 $_SESSION['psname']=$psname;
			 
			 //$reg_id=2021;//for now taking constant
			 $evidence_error=1;
			 //uploading missing object evidence
			 $upload_dir="Missing_object/";
    		 	 $allowed_types = array('jpg', 'jpeg', 'png');
    		// Checks if user sent an empty form
			$upload_error=0;
    		if(!empty(array_filter($_FILES['upload']['name']))) 
    		{
				
			$evidence_error=0;
			
        		// Loop through each file in files[] array
        	 	foreach ($_FILES['upload']['tmp_name'] as $key => $value) 
			{
             
            		$file_tmpname = $_FILES['upload']['tmp_name'][$key];
            		$file_name = $_FILES['upload']['name'][$key];
            
            		$file_size = $_FILES['upload']['size'][$key];
            		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		 		$COUNT=$key+1;
            		$evidence_name=$upload_dir.$gdNo."evidence-".$COUNT.".".$file_ext;
		 		$evidence=$upload_dir.$gdNo."evidence-1".".".$file_ext;
            		// Set upload file path
            		$filepath = $upload_dir.$file_name;
 			 	
            		// Check file type is allowed or not
            		if(in_array(strtolower($file_ext), $allowed_types)) 
			{
                
                		// If file with name already exist then append time in
                		// front of name of the file to avoid overwriting of file
                		if(file_exists($filepath)) 
				{
                    			$filepath = $upload_dir.time().$file_name;
                     
                    			if( move_uploaded_file($file_tmpname, $filepath)) 
					{
                        			//echo "{$file_name} successfully uploaded <br />";
                        			rename($filepath,$evidence_name);		  

                    			}
                    			else 
					{ 
						$upload_error=1;                   
                        			echo "Error uploading {$file_name} <br />";
                    			}
                		}

                		else 
						{
                 
                    			if( move_uploaded_file($file_tmpname, $filepath)) 
					{
                        			//echo "{$file_name} successfully uploaded <br />";
                        			rename($filepath,$evidence_name);
                    			}
                    			else 
						{   
				   		$upload_error=1;                 
                        		echo "Error uploading {$file_name} <br />";
                    		}
                	}
					$_SESSION['evidence_name']=$evidence;
            	}
            	else 
		{
                 
                // If file extension not valid
				 $upload_error=1;
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }
$insert=0;
//uploading signature
			 $insert=1;
			 $upload_dir="Sign/";
    		 	 $allowed_types = array('jpg', 'jpeg', 'png');
    		      $filename=$_FILES["signature"]["name"];
			 $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
			 $tempname=$_FILES["signature"]["tmp_name"];
			 $folder="Sign/".$filename;
			 
			 // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types))
	     {
			 $sign_name="Sign/".$gdNo.".".$file_ext;
			 $sign_letter=$gdNo.".".$file_ext;
			 move_uploaded_file($tempname,$folder);
			 rename($folder,$sign_name);
            }
	     else
	     {
			echo "Error uploading {$filename} ";
                	echo "({$file_ext} file type is not allowed)<br / >";	
	     }  
   
			


			 
			 $_SESSION['sign_name']=$sign_name;
			 $_SESSION['sign_letter']=$sign_letter;
        	 //insert records into Record table
			 if($evidence_error==0)
            		{
			 
				$res=mysqli_query($conn,"INSERT INTO COMPLAINT_STATUS(COMPLAINT_NO,COMPLAINT_TYPE,STATUS) 
			 	values('$gdNo','GD_DETAILS','UNATTENDED')");

            			

				$result=mysqli_query($conn,"INSERT INTO GD_DETAILS(REG_ID,GD_NO,ObjectName,Object_details,Mobile,Email,Location,DateTime,PSNAME,Evidence,Sign) 
			 	values('$REG_ID','$gdNo','$ObjectName','$odetails','$mobile','$email','$location','$datetime','$psname','$evidence','$sign_name')");
         			
			 }
			 else if($evidence_error==1)
			 {


				$res=mysqli_query($conn,"INSERT INTO COMPLAINT_STATUS(COMPLAINT_NO,COMPLAINT_TYPE,STATUS) 
			 	values('$gdNo','GD_DETAILS','UNATTENDED')");

				$result=mysqli_query($conn,"INSERT INTO GD_DETAILS(REG_ID,GD_NO,ObjectName,Object_details,Mobile,Email,Location,DateTime,PSNAME,Sign) 
			 	values('$REG_ID','$gdNo','$ObjectName','$odetails','$mobile','$email','$location','$datetime','$psname','$sign_name')");
			 	
			}
			 if($upload_error==0)
			{
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
			 .input {
  font-size: 1em;
  background-color: #69ad5b;
  color: white;
  border: 0px solid;
  border-radius: 4px;
  height: 40px;
  width: 80px;
  margin: 10px;
}
		   </style>
		";
			 echo"<body bgcolor='beige'>";
			 echo"<div class='card'>";

			 echo "<h1> GD for Registration no: ".$_SESSION['REG_ID']." is submitted successfully.<h1>";
			 echo "<p>Note down the GD No:".$_SESSION['gdno']." for future reference.</p><br>";
			}
			 
			 if($result)
            		{
                		echo " ";
           		}
            		else
            		{
                		echo "Error: " . $result . "<br>" . $conn->error;
            		}
        

    }


			echo "<form action='PDFGD.php' method='POST' >"; 
			//echo "<br><br>";
			echo "<center><input type='submit' value='Download GD' name='submits' >";

			echo "</form>";
			echo "</p>";
			echo "</body>";
			echo "</html>"	;

?>


<?php
$conn->close();

?>
