<?php
    include("config.php");
    session_start();
    $REG_ID=$_SESSION['REG_ID'];
?>
  <?php
    $mobile_err=$name_err=$fathername_err=$photo_err="";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //$TID=rand(10000,100000);
        $TID=$_POST['photoid'];
        echo $TID;
        $idtype=$_POST['photoidtype'];
        echo $idtype;
        if(empty($_POST['fullName']))
            $name_err="Name has to be entered";
        else
            $name=$_POST['fullName'];
        $verify=$_POST['dates'];
        if(empty($_POST['fathername']))
            $fathername_err="feature has to be entered";
        else
            $fathername=$_POST['fathername'];
        $address=$_POST['address'];
        $gender=$_POST['gender'];  
        $upload_dir="Timg/";
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
                $photoname=$upload_dir.$name."-".($count).".".$file_ext;
            
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
    }
    
        if(empty($name_err) && empty($fathername_err) && !empty($photoname)&& !empty($TID))
           {
            
            $result=mysqli_query($conn,"insert into id_verification(REG_ID,DOC_VERIFIED,ID_NUMBER,ADDRESS,GENDER,NAME,FEATURE,PHOTO,DATE_VERIFY) values('$REG_ID','$idtype','$TID','$address','$gender','$name','$fathername','$photoname','$verify')");
            //$result=$conn->query($sql);
            if($result)
            {
                $_SESSION['name']=$name;
                $_SESSION['photo']=$photoname;
                $command = escapeshellcmd('Python "C:\xampp\htdocs\DOT\tenant_update.py"');
                $output = shell_exec($command);
                echo $output;
        $Nomatch="No suitable match found.";
        $error="Error:Trouble connecting with phpMyAdmin";
        $_SESSION['output'] = $output;
        if(strcmp($Nomatch, $output) == 0)
        {
            header("Location: match.php"); // Auto redirect 
            exit;
        }
        else if(strcmp($Nomatch, $output) == 0)
        {
            header("Location: match.php"); // Auto redirect
            exit;
        }
        else
        {
            header("Location: match.php"); // Auto redirect
            exit;
        }

            }
            else
            {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
        }
    }
$conn->close();
?>