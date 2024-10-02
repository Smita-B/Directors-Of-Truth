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



$crime1 = ['Accident', 'Child Labour', 'Witch Act', 'Domestic Violence', 'Dowry Act', 'Eve Teasing','Gambling Act','Others'];
    
$crime2 = ['Swindle','Extortion' , 'Theft', 'Loot' , 'Fraud'];
  
$crime3 = [ 'Kidnapping','Ransom', 'Smuggling' , 'Protection racketeering' , 'Loan sharking' , 'Drug-trafficking'];
     
$crime4 = ['Murder', 'Terrorism','Organized Riot', 'Rape', 'Riot', 'Robbery'];

//$crime="Kidnapping";


          
    //post method to pass variables from html code to php in a page
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
		 	$REG_ID=$_SESSION['REG_ID'];
			 $firNo=rand(100000,100000000);
			 $CrimeName=$_POST['crime'];
             $accused=$_POST['accused'];
        	 $cdetails=$_POST['cdetails'];
             $mobile=$_POST['mobile'];
        	 $email=$_POST['email'];
        	 $location= $_POST['location'];
             $datetime= $_POST['dates'];
			 $psname=$_POST['ps'];
			 $_SESSION['firno']=$firNo;
             $_SESSION['REG_ID']=$REG_ID;
        	 
		 //assigning crime weight
			if (in_array("$CrimeName", $crime1))
			{
				$c_weight=1;
  				//echo "Match found";
				//echo "<br> c_weight= ".$c_weight;
			}
			else if (in_array("$CrimeName", $crime2))
			{
				$c_weight=2;
  				//echo "Match found";
				//echo "<br> c_weight= ".$c_weight;
  	
			}

			else if (in_array("$CrimeName", $crime3))
			{
				$c_weight=3;
  				//echo "Match found";
				//echo "<br> c_weight= ".$c_weight;
  	
			}

			else if (in_array("$CrimeName", $crime4))
			{
				$c_weight=4;
  				//echo "Match found";
				//echo "<br> c_weight= ".$c_weight;
  	
			}
			else
			{
				$c_weight=0;
  				//echo "Match not found";
			}
		
		//insert records into Record table

		 $res=mysqli_query($conn,"INSERT INTO COMPLAINT_STATUS(COMPLAINT_NO,COMPLAINT_TYPE,STATUS) 
		 values('$firNo','FIR_DETAILS','UNATTENDED')");
           	 $result=mysqli_query($conn,"INSERT INTO FIR_DETAILS(REG_ID,FIR_NO,CrimeName,CRIME_WEIGHT,AccusedPerson,Crime_details,Mobile,Email,Location,Date,PSNAME) 
			 values('$REG_ID','$firNo','$CrimeName','$c_weight','$accused','$cdetails','$mobile','$email','$location','$datetime','$psname')");
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
			 echo"<body bgcolor='beige'>";
			 echo"<div class='card'>";

			 echo "<h1> FIR for Registration no: ".$_SESSION['REG_ID']." is submitted successfully.<h1>";
			 echo "<p>Note down the FIR No:".$_SESSION["firno"]." for future reference.</p><br>";

			 echo "<form action='menu.php' method='POST'> <button class='button' id='submit' type='submit'>Menu</button></form></div>";
        		

    }
$conn->close();

?>
