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
$REG_ID=$_SESSION['REG_ID'];
$_SESSION['REG_ID']=$REG_ID;
?>
		
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    background-color: #fff;
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
<h1>
  COMPLAINTS:
</h1>

	
	<?php
		$emp=1;
				$result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS AS F,COMPLAINT_STATUS AS C WHERE  F.FIR_NO=C.COMPLAINT_NO AND F.REG_ID=$REG_ID"); // fetching fir details
        //$result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS WHERE REG_ID=$REG_ID"); // fetching fir details
				$result1=mysqli_query($conn,"SELECT * FROM GD_DETAILS AS G,COMPLAINT_STATUS AS C WHERE  G.GD_NO=C.COMPLAINT_NO AND G.REG_ID=$REG_ID"); // fetching gd details
        //$result1=mysqli_query($conn,"SELECT * FROM GD_DETAILS WHERE REG_ID=$REG_ID"); // fetching gd details
				$result2=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE REG_ID=$REG_ID "); // fetching Missing details

				if ($result->num_rows > 0) 
					{
						$emp=0;
	?>
		<h2>FIR REPORTS : </h2>
		<main>
  		<table>
    	
      	<tr>
    			<th>REG ID</th>
    			<th>FIR NO</th>
    			<th>INCIDENT REPORTED</th>
          <th>STATUS</th>
				<th>VIEW DETAILS</th>
				</tr>
	<?php
 					while($row = $result->fetch_assoc())
					{
						  
						
	?>
	
      			<tr>
        		<td data-title='REG ID' ><?php echo $row['REG_ID'] ?></td>
        		<td data-title='FIR NO' ><?php echo $row['FIR_NO'] ?></td>
        		<td data-title='CRIME NAME'><?php echo $row['CrimeName'] ?></td>
            <td data-title='status'><?php echo $row['STATUS'] ?></td>
				<td> <a href="VIEWcomplaintUSER.php?fn=<?php echo $row['FIR_NO'] ?> & table=FIR_DETAILS">Click to view</a></td>
    	</tr>

    	<?php
					}
					//echo "<br><br>";
				}
				
			
		
			
		if ($result1->num_rows > 0) 
		{
			$emp=0;
			
	?>
			</tbody>
			</table>
			
			</main>
			<h2>GD REPORTS :</h2>
			<main>
  			<table>
      		<tr>
    			<th>REG ID</th>
    			<th>GD NO</th>
    			<th>OBJECT NAME</th>
          <th>STATUS</th>
				<th>VIEW DETAILS</th>
  		</tr>
	<?php
 					while($row = $result1->fetch_assoc())
					{
	?>
		<tr>
        			<td data-title='REG ID'><?php echo $row['REG_ID'] ?></td>
        			<td data-title='GD NO'><?php echo $row['GD_NO'] ?></td>
        			<td data-title='OBJECT NAME'><?php echo $row['ObjectName'] ?></td>
        			<td data-title='status'><?php echo $row['STATUS'] ?></td>
					<td> <a href="VIEWcomplaintUSER.php?fn=<?php echo $row['GD_NO'] ?> & table=GD_DETAILS">Click to view </a></td>
    			</tr>
    	<?php
					}
					//echo "<br><br>";
				}
					
		
		if ($result2->num_rows > 0) 
		{
			$emp=0;
				
		?>
		</tbody>
			</table>
			
		</main>
			<h2>MISSING REPORTS :</h2>
			<main>
  			<table>
			  <tr>
					<th>REG ID</th>
					<th>MISSING ID</th>
					<th>MISSING PERSON NAME</th>
          <th>STATUS</th>
					<th>VIEW DETAILS</th>
			  </tr>
		<?php
						 while($row = $result2->fetch_assoc())
						{
							$PHOTO=$row['PHOTO'];
		?>
			<tr>
							<td data-title='REG ID'>
							<?php echo $row['REG_ID'] ?>
        					</td>
        					<td data-title='MISSING ID'>
							<?php echo $row['M_ID'] ?>
        					</td>
							<td data-title='MISSING PERSON NAME'>
							<?php echo $row['M_NAME'] ?>
        					</td>
                <td data-title='status'><?php echo $row['STATUS'] ?></td>
        					<td class='Click to view'>
          					<a class='button' href='VIEWcomplaintUSER.php?fn=<?php echo $row["M_ID"] ?> & table=MISSING_REPORT'>
							Click to view
          					</a>
        					</td>
						</tr>
			<?php
						}
						
					}
						
			
			?>
			</tbody>
			</table>
			</main>
			<main>
  			<table>
    		<thead >
			<tr>
			<?php
			if ($emp> 0) 
			{
				?>
				<th style="text-align: center">No records found</th>
				</tr>
    			</thead>
				</table>
				</main>
				<?php
				//echo "No records found";
			}
			?>
		
			
			
			
<?php
			


	$conn->close();
	?>
	<br><br>
	<!--<CENTER><a target="_ " href="profile1.php"><input type="button" value="Back" class='close'><br><br></CENTER></a>-->
  <CENTER><a target="_ " href="profile1.php" class='close'>Back<br></CENTER></a>

	</form>	
</body>
</html>