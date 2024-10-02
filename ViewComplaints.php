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


?>
		
<!doctype html>
<html>
<head>
	<title></title>
	  <style type="text/css">
	  	* {
  box-sizing: border-box;
}

html.open,
body.open {
  height: 100%;
  overflow: hidden;
}

html {
  padding: 40px;
  font-size: 62.5%;
}

body {
  padding: 20px;
  background-color: #fffaae;
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
  color: black;
  font-size: 1.6rem;
  font-family: "Lato", sans-serif;
}

p {
  text-align: center;
  margin: 10px 0 40px;
}

main {
  background-color: #fffaae;
}

h1 {
  text-align: center;
  font-weight: 300;
}

table {
  display: block;
}

tr,
td,
tbody,
tfoot {
  display: block;
}

thead {
  display: none;
}

tr {
  padding-bottom: 10px;
}

td {
  padding: 10px 10px 0;
  text-align: center;
}
td:before {
  content: attr(data-title);
  color: #733e4a;
  text-transform: uppercase;
  font-size: 1.4rem;
  padding-right: 10px;
  display: block;
}

table {
  width: 100%;
}

th {
  text-align: left;
  font-weight: 700;
}

thead th {
  background-color: #6e3642;
  color: #733e4a;
  border: #6e3642;
}

tfoot th {
  display: block;
  padding: 10px;
  text-align: center;
  color: #733e4a;
}

.button {
  line-height: 1;
  display: inline-block;
  font-size: 1.2rem;
  text-decoration: none;
  border-radius: 5px;
  color: #733e4a;
  padding: 8px;
  background-color: #733e4a;
}

.select {
  padding-bottom: 20px;
  border-bottom: #59041d;
}
.select:before {
  display: none;
}

.detail {
  background-color: #733e4a;
  width: 100%;
  height: 100%;
  padding: 40px 0;
  position: fixed;
  top: 0;
  left: 0;
  overflow: auto;
  -moz-transform: translateX(-100%);
  -ms-transform: translateX(-100%);
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
  -moz-transition: -moz-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  -webkit-transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
}
.detail.open {
  -moz-transform: translateX(0);
  -ms-transform: translateX(0);
  -webkit-transform: translateX(0);
  transform: translateX(0);
}

.detail-container {
  margin: 0 auto;
  padding: 40px;
  max-width: 500px;
}

dl {
  margin: 0;
  padding: 0;
}

dt {
  font-size: 2.2rem;
  font-weight: 300;
}

dd {
  margin: 0 0 40px 0;
  font-size: 1.8rem;
  padding-bottom: 5px;
  border-bottom: #733e4a;
  box-shadow: 0 1px 0 #733e4a;
}

.close {
  background: none;
  padding: 18px;
  color: #000;
  font-weight: 300;
  border: rgba(255, 255, 255, 0.4);
  border-radius: 4px;
  line-height: 1;
  font-size: 1.8rem;
  position: fixed;
  right: 40px;
  top: 20px;
  -moz-transition: border 0.3s linear;
  -o-transition: border 0.3s linear;
  -webkit-transition: border 0.3s linear;
  transition: border 0.3s linear;
}
.close:hover, .close:focus {
  background-color: #733e4a;
  border: #59041d;
}

@media (min-width: 460px) {
  td {
    text-align: left;
  }
  td:before {
    display: inline-block;
    text-align: right;
    width: 140px;
  }

  .select {
    padding-left: 160px;
  }
}
@media (min-width: 620px) {
  table {
    display: table;
  }

  tr {
    display: table-row;
  }

  td,
  th {
    display: table-cell;
  }

  tbody {
    display: table-row-group;
  }

  thead {
    display: table-header-group;
  }

  tfoot {
    display: table-footer-group;
  }

  td {
    border: #733e4a;
  }
  td:before {
    display: none;
  }

  td,
  th {
    padding: 10px;
    background-color: #7e3a4e;
  }
  tr:nth-child(n) td{
  	background-color: #b28690;
  }
  tr:nth-child(2n + 2) td {
    background-color: #b7919c;
  }

  tfoot th {
    display: table-cell;
  }

  .select {
    padding: 10px;
  }
}
a:link, a:visited {
  background-color: #390716;
  color: white;
  padding: 8px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
	  </style>

</head>
<body>
	<main>
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$err="";
			if(empty($_POST['attribute'])    )
			{
			  $err="ERROR"; //error message
			}
			if($err=="ERROR")
			{
				$result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS AS F,COMPLAINT_STATUS AS C WHERE  F.FIR_NO=C.COMPLAINT_NO "); // fetching fir details
				$result1=mysqli_query($conn,"SELECT * FROM GD_DETAILS AS G,COMPLAINT_STATUS AS C WHERE  G.GD_NO=C.COMPLAINT_NO "); // fetching gd details
				$result2=mysqli_query($conn,"SELECT * FROM MISSING_REPORT "); // fetching Missing details

				if ($result->num_rows > 0) 
					{
	?>
			<center><h1>FIR REPORTS : </h1></center>
			<table>
				<thead>
  		<tr>
    			<th>REG ID</th>
    			<th>FIR NO</th>
    			<th>INCIDENT REPORTED</th>
    			<th>ACCUSED PERSON</th>
				<th>CRIME DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE & TIME</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result->fetch_assoc())
					{
						  
						
	?>
	
		<tr>
        		<td><?php echo $row['REG_ID'] ?></td>
        		<td><?php echo $row['FIR_NO'] ?></td>
        		<td><?php echo $row['CrimeName'] ?></td>
        		<td><?php echo $row['AccusedPerson'] ?></td>
				<td><?php echo $row['Crime_details'] ?></td>
				<td><?php echo $row['Location'] ?></td>
				<td><?php echo $row['PSNAME'] ?></td>
				<td><?php echo $row['DATE'] ?></td>
				<td><?php echo $row['STATUS'] ?></td>
				<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['FIR_NO'] ?> & table=FIR_DETAILS">Click to update </a></td>
    	</tr>
			</thead>
    	<?php
					}
					echo "<br><br>";
				}
				else 
				echo "<center><b><br><br>No records found </center></b>";	
			
		
			
		if ($result1->num_rows > 0) 
		{
			
	?>
	</table><br><br><br><br><b><center><h1>GD REPORTS </h1></center></b>
			<table>
  		<tr>
    			<th>REG ID</th>
    			<th>GD NO</th>
    			<th>OBJECT NAME</th>
				<th>OBJECT DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE & TIME</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result1->fetch_assoc())
					{
	?>
	
		<tr>
        			<td><?php echo $row['REG_ID'] ?></td>
        			<td><?php echo $row['GD_NO'] ?></td>
        			<td><?php echo $row['ObjectName'] ?></td>
        			<td><?php echo $row['Object_details'] ?></td>
					<td><?php echo $row['Location'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATETIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['GD_NO'] ?> & table=GD_DETAILS">Click to update </a></td>
    			</tr>
    	<?php
					}
					echo "<br><br>";
				}
				else 
					echo "<center><b><br><br>No records found </center></b>";	
		
		if ($result2->num_rows > 0) 
		{
				
		?>
		</table><br><br><br><br>
				<b><h1>MISSING REPORTS </h1></b>
				<table>
			  <tr>
					<th>REG ID</th>
					<th>MISSING ID</th>
					<th>MISSING PERSON NAME</th>
					<th>PHOTO</th>
					<th>GENDER</th>
					<th>AGE</th>
					<th>FEATURE</th>
					<th>LOCATION</th>
					<th>PSNAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>STATUS</th>
					<th>UPDATE STATUS</th>
			  </tr>
		<?php
						 while($row = $result2->fetch_assoc())
						{
							$PHOTO=$row['PHOTO'];
		?>
		
			<tr>
					<td><?php echo $row['REG_ID'] ?></td>
					<td><?php echo $row['M_ID'] ?></td>
					<td><?php echo $row['M_NAME'] ?></td>
					<td><img src="<?php echo $PHOTO  ?>" height="50" width="50" ></td>
					<td><?php echo $row['GENDER'] ?></td>
					<td><?php echo $row['AGE'] ?></td>
					<td><?php echo $row['FEATURE'] ?></td>
					<td><?php echo $row['LOCATION'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATE'] ?></td>
					<td><?php echo $row['TIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['M_ID'] ?> & table=MISSING_REPORT">Click to update </a></td>
					</tr>
			<?php
						}
						echo "<br><br>";
					}
					else 
						echo "<center><b><br><br>No records found </center></b>";	
			
			}
			?> </table><br><br>

			<?php

		
			if(empty($err))
			{
				$attribute=$_POST['attribute'];
				$PS=$_POST['ps'];
				$CID=$_POST['cid'];
				$Q=0;//FOR CHECKING IF ANY RECORD EXISTS WITH THE GIVEN INFO
				if($attribute=="PSNAME")// WHEN PSNAME SELECTED IN DROPDOWN
				{
					//echo "<b>FIR REPORTS : </b>"; 
					$result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS AS F,COMPLAINT_STATUS AS C WHERE  F.FIR_NO=C.COMPLAINT_NO AND PSNAME='$PS'"); // fetching fir details
					$result1=mysqli_query($conn,"SELECT * FROM GD_DETAILS AS G,COMPLAINT_STATUS AS C WHERE  G.GD_NO=C.COMPLAINT_NO AND PSNAME='$PS'"); // fetching gd details
					$result2=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE  PSNAME='$PS'"); // fetching Missing details
				

					if ($result->num_rows > 0) 
					{
						$Q=1;
	?>
			<b>FIR REPORTS : </b>
			<table>
  		<tr>
    			<th>REG ID</th>
    			<th>FIR NO</th>
    			<th>INCIDENT REPORTED</th>
    			<th>ACCUSED PERSON</th>
				<th>CRIME DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE & TIME</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result->fetch_assoc())
					{
	?>
	
		<tr>
        		<td><?php echo $row['REG_ID'] ?></td>
        		<td><?php echo $row['FIR_NO'] ?></td>
        		<td><?php echo $row['CrimeName'] ?></td>
        		<td><?php echo $row['AccusedPerson'] ?></td>
				<td><?php echo $row['Crime_details'] ?></td>
				<td><?php echo $row['Location'] ?></td>
				<td><?php echo $row['PSNAME'] ?></td>
				<td><?php echo $row['DATE'] ?></td>
				<td><?php echo $row['STATUS'] ?></td>
				<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['FIR_NO'] ?> & table=FIR_DETAILS">Click to update </a></td>
    	</tr>
			
    	<?php
					}
					echo "<br><br>";
				}
				
			
		
			
		if ($result1->num_rows > 0) 
		{
			$Q=1;
			
	?>
	</table><br><br><b>GD REPORTS :</b>
			<table>
  		<tr>
    			<th>REG ID</th>
    			<th>GD NO</th>
    			<th>OBJECT NAME</th>
				<th>OBJECT DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE & TIME</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result1->fetch_assoc())
					{
	?>
	
		<tr>
        			<td><?php echo $row['REG_ID'] ?></td>
        			<td><?php echo $row['GD_NO'] ?></td>
        			<td><?php echo $row['ObjectName'] ?></td>
        			<td><?php echo $row['Object_details'] ?></td>
					<td><?php echo $row['Location'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATETIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['GD_NO'] ?> & table=GD_DETAILS">Click to update </a></td>
    			</tr>
    	<?php
					}
					echo "<br><br>";
				}
				
			
		
		if ($result2->num_rows > 0) 
		{
			$Q=1;
				
		?>
		</table><br><br>
				<b>MISSING REPORTS :</b>
				<table>
			  <tr>
					<th>REG ID</th>
					<th>MISSING ID</th>
					<th>MISSING PERSON NAME</th>
					<th>PHOTO</th>
					<th>GENDER</th>
					<th>AGE</th>
					<th>FEATURE</th>
					<th>LOCATION</th>
					<th>PSNAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>STATUS</th>
					<th>UPDATE STATUS</th>
			  </tr>
		<?php
						 while($row = $result2->fetch_assoc())
						{
							$PHOTO=$row['PHOTO'];
		?>
		
			<tr>
					<td><?php echo $row['REG_ID'] ?></td>
					<td><?php echo $row['M_ID'] ?></td>
					<td><?php echo $row['M_NAME'] ?></td>
					<td><img src="<?php echo $PHOTO  ?>" height="100" width="100" ></td>
					<td><?php echo $row['GENDER'] ?></td>
					<td><?php echo $row['AGE'] ?></td>
					<td><?php echo $row['FEATURE'] ?></td>
					<td><?php echo $row['LOCATION'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATE'] ?></td>
					<td><?php echo $row['TIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['M_ID'] ?> & table=MISSING_REPORT">Click to update </a></td>
					</tr>
			<?php
						}
						echo "<br><br>";
			}
			if($Q==0)	
				echo "<center><b><br><br>No records found for the selected police station</center></b>";		  
			
				}
			?> </table><br><br>
			<?php
			if(empty($err))
			{
				if($attribute=="C_ID")
				{
					
					$ctype="";
					$result=mysqli_query($conn,"SELECT * FROM COMPLAINT_STATUS WHERE COMPLAINT_NO='$CID'");
					
					if ($result->num_rows > 0) 
					{
						echo "<b>COMPLAINTS : <br></b>"; 
						$row = $result->fetch_assoc();
						$ctype=$row['COMPLAINT_TYPE'];
						$STATUS=$row['STATUS'];
					}
					
					//echo $ctype;
					$F=0;
					$G=0;
					$M=0;

					if($ctype == "FIR_DETAILS")
					{
						$F=1;
						$result1=mysqli_query($conn,"SELECT * FROM $ctype WHERE FIR_NO= '$CID' ");
						$row1 = $result1->fetch_assoc();
						$REG=$row1['REG_ID'];
						$FIR=$row1['FIR_NO'];
						$CNAME=$row1['CrimeName'];
						$AP=$row1['AccusedPerson'];
						$CD=$row1['Crime_details'];
						$LOC=$row1['Location'];
						$PSNAME=$row1['PSNAME'];
						$DT=$row1['DATE'];
					

					}
					if($ctype == "GD_DETAILS")
					{
						$G=1;
						$result1=mysqli_query($conn,"SELECT * FROM $ctype WHERE GD_NO= '$CID' ");
						$row1 = $result1->fetch_assoc();
						$REG=$row1['REG_ID'];
						$GD=$row1['GD_NO'];
						$ONAME=$row1['ObjectName'];
						$OD=$row1['Object_details'];
						$LOC=$row1['Location'];
						$PSNAME=$row1['PSNAME'];
						$DT=$row1['DATETIME'];

					}
					if($M==0)
					{
						$result1=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE M_ID= '$CID' ");
						if ($result1->num_rows > 0)
						{
							$M=1;
						}
					}
					$result=mysqli_query($conn,"SELECT * FROM COMPLAINT_STATUS WHERE COMPLAINT_NO='$CID'");
				if ($result->num_rows > 0) 
				{
					if($F==1)
					{
	?>
						<table border="2">
  						<tr>
    					<th>COMPLAINT ID</th>
						<th>COMPLAINT TYPE</th>
						<th>REG ID</th>
    					<th>INCIDENT REPORTED</th>
    					<th>ACCUSED PERSON</th>
						<th>CRIME DETAILS</th>
						<th>LOCATION</th>
						<th>PSNAME</th>
						<th>DATE</th>
						<th>STATUS</th>
						<th>UPDATE STATUS</th>
  						</tr>
	<?php
	//echo $REG;
 						while($row = $result->fetch_assoc())
						{
	?>
	
							<tr>
        					<td><?php echo $row['COMPLAINT_NO'] ?></td>
							<td><?php echo "FIR" ?></td>
        					<td><?php echo $REG ?></td>
        					<td><?php echo $CNAME ?></td>
							<td><?php echo $AP ?></td>
        					<td><?php echo $CD ?></td>
        					<td><?php echo $LOC ?></td>
							<td><?php echo $PSNAME ?></td>
							<td><?php echo $DT ?></td>
							<td><?php echo $STATUS ?></td>
							<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['COMPLAINT_NO'] ?> & table=FIR_DETAILS">Click to update </a></td>
        					</tr>
    	<?php
						}


					}
					
					if($G==1)
					{
						?>
						<table border="2">
  						<tr>
    					<th>COMPLAINT ID</th>
						<th>COMPLAINT TYPE</th>
						<th>REG ID</th>
    					<th>OBJECT NAME</th>
						<th>OBJECT DETAILS</th>
						<th>LOCATION</th>
						<th>PSNAME</th>
						<th>DATE & TIME</th>
						<th>STATUS</th>
						<th>UPDATE STATUS</th>
  						</tr>
	<?php
	//echo $REG;
 						while($row = $result->fetch_assoc())
						{
	?>
	
							<tr>
        					<td><?php echo $row['COMPLAINT_NO'] ?></td>
							<td><?php echo "GD" ?></td>
        					<td><?php echo $REG ?></td>
        					<td><?php echo $ONAME ?></td>
        					<td><?php echo $OD ?></td>
							<td><?php echo $LOC ?></td>
							<td><?php echo $PSNAME ?></td>
							<td><?php echo $DT ?></td>
							<td><?php echo $STATUS ?></td>
							<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['COMPLAINT_NO'] ?> & table=GD_DETAILS">Click to update </a></td>
        					</tr>
    	<?php
						}


					}
					echo "<br><br>";
			}
			else if($M==1)
			{
				?>
				<br><br>
				<table border="2">
			  	<tr>
					<th>REG ID</th>
					<th>MISSING ID</th>
					<th>COMPLAINT TYPE</th>
					<th>MISSING PERSON NAME</th>
					<th>PHOTO</th>
					<th>GENDER</th>
					<th>AGE</th>
					<th>FEATURE</th>
					<th>LOCATION</th>
					<th>PSNAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>STATUS</th>
					<th>UPDATE STATUS</th>
			  	</tr>
				  <?php
						$result1=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE M_ID= '$CID' ");
						$row = $result1->fetch_assoc();
						$PHOTO=$row['PHOTO'];
					?>
						<tr>
						<td><?php echo $row['REG_ID'] ?></td>
						<td><?php echo $row['M_ID'] ?></td>
						<td><?php echo "MISSING REPORT" ?></td>
						<td><?php echo $row['M_NAME'] ?></td>
						<td><img src="<?php echo $PHOTO  ?>" height="50" width="50" ></td>
						<td><?php echo $row['GENDER'] ?></td>
						<td><?php echo $row['AGE'] ?></td>
						<td><?php echo $row['FEATURE'] ?></td>
						<td><?php echo $row['LOCATION'] ?></td>
						<td><?php echo $row['PSNAME'] ?></td>
						<td><?php echo $row['DATE'] ?></td>
						<td><?php echo $row['TIME'] ?></td>
						<td><?php echo $row['STATUS'] ?></td>
						<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['M_ID'] ?> & table=MISSING_REPORT">Click to update </a></td>
						</tr>
		<?php
			} 
			else 
			echo "<center><b><br><br>No records found for the Complaint No. :".$CID." </center></b>";	
			}
	}
		
}
}
else
{
	$result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS AS F,COMPLAINT_STATUS AS C WHERE  F.FIR_NO=C.COMPLAINT_NO "); // fetching fir details
				$result1=mysqli_query($conn,"SELECT * FROM GD_DETAILS AS G,COMPLAINT_STATUS AS C WHERE  G.GD_NO=C.COMPLAINT_NO "); // fetching gd details
				$result2=mysqli_query($conn,"SELECT * FROM MISSING_REPORT "); // fetching Missing details

				if ($result->num_rows > 0) 
					{
	?>
			<b>FIR REPORTS : </b>
			<table border="2">
  		<tr>
    			<th>REG ID</th>
    			<th>FIR NO</th>
    			<th>INCIDENT REPORTED</th>
    			<th>ACCUSED PERSON</th>
				<th>CRIME DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result->fetch_assoc())
					{
						  
						
	?>
	
		<tr>
        		<td><?php echo $row['REG_ID'] ?></td>
        		<td><?php echo $row['FIR_NO'] ?></td>
        		<td><?php echo $row['CrimeName'] ?></td>
        		<td><?php echo $row['AccusedPerson'] ?></td>
				<td><?php echo $row['Crime_details'] ?></td>
				<td><?php echo $row['Location'] ?></td>
				<td><?php echo $row['PSNAME'] ?></td>
				<td><?php echo $row['DATE'] ?></td>
				<td><?php echo $row['STATUS'] ?></td>
				<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['FIR_NO'] ?> & table=FIR_DETAILS">Click to update </a></td>
    	</tr>
			
    	<?php
					}
					echo "<br><br>";
				}
				else 
				echo "<center><b><br><br>No records found </center></b>";	
			
		
			
		if ($result1->num_rows > 0) 
		{
			
	?>
	</table><br><br><b>GD REPORTS :</b>
			<table border="2">
  		<tr>
    			<th>REG ID</th>
    			<th>GD NO</th>
    			<th>OBJECT NAME</th>
				<th>OBJECT DETAILS</th>
				<th>LOCATION</th>
				<th>PSNAME</th>
				<th>DATE & TIME</th>
				<th>STATUS</th>
				<th>UPDATE STATUS</th>
  		</tr>
	<?php
 					while($row = $result1->fetch_assoc())
					{
	?>
	
		<tr>
        			<td><?php echo $row['REG_ID'] ?></td>
        			<td><?php echo $row['GD_NO'] ?></td>
        			<td><?php echo $row['ObjectName'] ?></td>
        			<td><?php echo $row['Object_details'] ?></td>
					<td><?php echo $row['Location'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATETIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['GD_NO'] ?> & table=GD_DETAILS">Click to update </a></td>
    			</tr>
    	<?php
					}
					echo "<br><br>";
				}
				else 
				echo "<center><b><br><br>No records found </center></b>";	
			
		
		if ($result2->num_rows > 0) 
		{
				
		?>
		</table><br><br>
				<b>MISSING REPORTS :</b>
				<table border="2">
			  <tr>
					<th>REG ID</th>
					<th>MISSING ID</th>
					<th>MISSING PERSON NAME</th>
					<th>PHOTO</th>
					<th>GENDER</th>
					<th>AGE</th>
					<th>FEATURE</th>
					<th>LOCATION</th>
					<th>PSNAME</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>STATUS</th>
					<th>UPDATE STATUS</th>
			  </tr>
		<?php
						 while($row = $result2->fetch_assoc())
						{
							$PHOTO=$row['PHOTO'];
		?>
		
			<tr>
					<td><?php echo $row['REG_ID'] ?></td>
					<td><?php echo $row['M_ID'] ?></td>
					<td><?php echo $row['M_NAME'] ?></td>
					<td><img src="<?php echo $PHOTO  ?>"  height="50" width="50" ></td>
					<td><?php echo $row['GENDER'] ?></td>
					<td><?php echo $row['AGE'] ?></td>
					<td><?php echo $row['FEATURE'] ?></td>
					<td><?php echo $row['LOCATION'] ?></td>
					<td><?php echo $row['PSNAME'] ?></td>
					<td><?php echo $row['DATE'] ?></td>
					<td><?php echo $row['TIME'] ?></td>
					<td><?php echo $row['STATUS'] ?></td>
					<td> <a href="updateCOMPLAINT2.php?fn=<?php echo $row['M_ID'] ?> & table=MISSING_REPORT">Click to update </a></td>
					</tr>
			<?php
						}
						echo "<br><br>";
					}
					else 
					echo "<center><b><br><br>No records found </center></b>";	
			
			}
			?> </table><br><br>

			<?php


	$conn->close();
	?>
	<a target="_ " href="admin dashboard.php" class='close'><CENTER>Back<br></CENTER></a>


	</form>	
</table>
</table>
</table>
</main>
</body>
</html>