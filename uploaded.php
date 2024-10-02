<?php
	include("config.php");
	session_start();
    $REG_ID=$_SESSION['REG_ID'];
$_SESSION['REG_ID']=$REG_ID;

?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
            $name=$_POST['Name'];
    		$upload_dir="compare/";
    		$allowed_types = array('jpg', 'jpeg');
    		if(!empty(array_filter($_FILES["upload"]["name"]))) 
    		{
        	 foreach ($_FILES['upload']['tmp_name'] as $key => $value) 
			 {
                $count=1;
             	$file_tmpname = $_FILES['upload']['tmp_name'][$key];
            	$file_name = $_FILES['upload']['name'][$key];
            
            	$file_size = $_FILES['upload']['size'][$key];
            	$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
	        echo $file_ext;
            	$photoname=$upload_dir.$name."-".($count).".".$file_ext;//Person who is searching
            
            	$filepath = $upload_dir.$file_name;
            	if(in_array(strtolower($file_ext), $allowed_types)) 
            	{
                if(file_exists($filepath)) 
				{
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) 
                    {
                        rename($filepath,$photoname);
                    }
                    else 
                    {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) 
                    {
                        rename($filepath,$photoname);
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
            }
            else 
            {
                 
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }       //delete existing records from table
            $result1=mysqli_query($conn,"DELETE FROM MISSING_DETAILS");
        	 //insert records into Record table
            $result=mysqli_query($conn,"INSERT INTO MISSING_DETAILS(Name,Image) 
			 values('$name','$photoname')");
            if($result)
            {
                $_SESSION['name']=$name;
                $_SESSION['photo']=$photoname;
                $command = escapeshellcmd('Python "C:/xampp/htdocs/DOT/facechena2.py"');
                $output = shell_exec($command);
                echo $output;
		$Nomatch="No suitable match found.";
		$error="Error:Trouble connecting with phpMyAdmin";
		$_SESSION['output'] = $output;
		
		if(strcmp("No suitable match found.",$output) == 0)
		{
			header("Location:face.php"); // Auto redirect 
			exit;
		}
        else if(strcmp("Error:Trouble connecting with phpMyAdmin",$output) == 0)
        {
            header("Location: missing.php"); // Auto redirect 
            exit;
        }
		else 
		{
			header("Location: face.php"); // Auto redirect
			exit;
		}
            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
    }
    
$conn->close();
?>

