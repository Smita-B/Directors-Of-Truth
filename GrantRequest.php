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
  text-decoration-color: black;
}

thead th {
  background-color: #6e3642;
  color: white;
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
  <h1>
  REQUESTS 
</h1>
<p>
  (Requests from users for getting details of possible match found)
</p>

  <h2>MISSING TABLE</h2>
	<?php
		$result2=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE STATUS='POSSIBLE MATCH FOUND' ");
		if ($result2->num_rows > 0) 
		{
				
		?>
		<main>
  		<table style="color: black;">
    	<thead>
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
		<th>DATE & TIME</th>
		<th>STATUS</th>
		<th>GRANT REQUEST</th>
		</tr>
    	</thead>
    	
		<?php
						 while($row = $result2->fetch_assoc())
						{
							$PHOTO=$row['PHOTO'];
		?>
		
							<tbody>
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
        					<td data-title='PHOTO'>
							<img src="<?php echo $PHOTO  ?>" height="50" width="50" alt=$PHOTO >
        					</td>
							<td data-title='GENDER'>
							<?php echo $row['GENDER'] ?>
        					</td>
							<td data-title='AGE'>
							<?php echo $row['AGE'] ?>
        					</td>
        					<td data-title='FEATURE'>
							<?php echo $row['FEATURE'] ?>
        					</td>
							<td data-title='LOCATION'>
							<?php echo $row['LOCATION'] ?>
        					</td>
							<td data-title='PSNAME'>
							<?php echo $row['PSNAME'] ?>
        					</td>
							<td data-title='DATE & TIME'>
							<?php echo $row['DATE'] ?>
        					</td>
							<td data-title='STATUS'>
							<?php echo $row['STATUS'] ?></td>
        					</td>
        					<td class='Grant Request'>
          					<a class='button' href='mail.php?fn=<?php echo $row["M_ID"] ?> & table=MISSING_REPORT'>
							<CENTER>Grant Request</CENTER>
          					</a>
        					</td>
					</tr>

			<?php
						}
						//echo "<br><br>";
			}
			else 
			echo "<center><b><br><br>No records found </center></b>";	
		
			?> 
			</tbody>
			</table>
			
		</main>
    <br><br>
    <h2>IDENTITY VERIFICATION TABLE</h2>
    <?php
    //$result3=mysqli_query($conn,"SELECT * FROM id_verification WHERE VERIFY_RESULT='MATCHED' ");
    $result3=mysqli_query($conn,"SELECT * FROM id_verification WHERE ID_NUMBER NOT IN (SELECT ID_NUMBER FROM id_verification WHERE VERIFY_RESULT='COMPLETED')");
    if ($result3->num_rows > 0) 
    {
        
    ?>
    <main>
      <table style="color: black;">
      <thead>
        <tr>
    <th>REG ID</th>
    <th>ID NUMBER</th>
    <th>NAME</th>
    <th>ADDRESS</th>
    <th>GENDER</th>
    <th>FEATURE</th>
    <th>PHOTO</th>
    <th>DATE OF VERIFICATION</th>
    <th>VERIFICATION RESULT</th>
    <th>GRANT REQUEST</th>
    </tr>
      </thead>
      
    <?php
             while($row = $result3->fetch_assoc())
            {
              $vr=$row["VERIFY_RESULT"];
              
              
              $PHOTO=$row['PHOTO'];
              if($vr=='Matched')
              {
    ?>
    
              <tbody>
                  <tr>
                  <td data-title='REG ID'>
              <?php echo $row['REG_ID'] ?>
                  </td>
                  <td data-title='MISSING ID'>
              <?php echo $row['ID_NUMBER'] ?>
                  </td>
              <td data-title='MISSING PERSON NAME'>
              <?php echo $row['NAME'] ?>
                  </td>
                  </td>
              <td data-title='MISSING PERSON NAME'>
              <?php echo $row['ADDRESS'] ?>
                  </td>
                  </td>
              <td data-title='GENDER'>
              <?php echo $row['GENDER'] ?>
                  </td>
                  <td data-title='FEATURE'>
              <?php echo $row['FEATURE'] ?>
                  </td>
                  <td data-title='PHOTO'>
              <img src="<?php echo $PHOTO  ?>" height="50" width="50" alt=$PHOTO >
                </td>
              <td data-title='DATE & TIME'>
              <?php echo $row['DATE_VERIFY'] ?>
                  </td>
              <td data-title='STATUS'>
              <?php echo $row['VERIFY_RESULT'] ?></td>
                  </td>
                  <td class='Grant Request'>
                    <a class='button' href='mails.php?fn=<?php echo $row["REG_ID"] ?> & pdist=<?php echo $row["PMATCH"] ?> & IN=<?php echo $row["ID_NUMBER"] ?> & table=id_verification'>
              <CENTER>Send Email</CENTER>
                    </a>
                  </td>
          </tr>

      <?php
            } 
            else
            {
              ?>
    
              <tbody>
                  <tr>
                  <td data-title='REG ID'>
              <?php echo $row['REG_ID'] ?>
                  </td>
                  <td data-title='MISSING ID'>
              <?php echo $row['ID_NUMBER'] ?>
                  </td>
              <td data-title='MISSING PERSON NAME'>
              <?php echo $row['NAME'] ?>
                  </td>
                  </td>
              <td data-title='MISSING PERSON NAME'>
              <?php echo $row['ADDRESS'] ?>
                  </td>
                  </td>
              <td data-title='GENDER'>
              <?php echo $row['GENDER'] ?>
                  </td>
                  <td data-title='FEATURE'>
              <?php echo $row['FEATURE'] ?>
                  </td>
                  <td data-title='PHOTO'>
              <img src="<?php echo $PHOTO  ?>" height="50" width="50" alt=$PHOTO >
                </td>
              <td data-title='DATE & TIME'>
              <?php echo $row['DATE_VERIFY'] ?>
                  </td>
              <td data-title='STATUS'>
              <?php echo $row['VERIFY_RESULT'] ?></td>
                  </td>
                  <td class='Grant Request'>
                    <a class='button' href='mailY.php?fn=<?php echo $row["REG_ID"] ?> & pdist=<?php echo $row["PMATCH"] ?> & IN=<?php echo $row["ID_NUMBER"] ?> & table=id_verification'>
              <CENTER>Accept</CENTER> 
                    </a><br><br>
                    <a class='button' href='mailN.php?fn=<?php echo $row["REG_ID"] ?> & pdist=<?php echo $row["PMATCH"] ?> & IN=<?php echo $row["ID_NUMBER"] ?> & table=id_verification'>
              <CENTER>Reject</CENTER>
                    </a>
                  </td>
          </tr>
          <?php
            }
            }
            
            
            }
            //echo "<br><br>";
    
      else 
      echo "<center><b><br><br>No records found </center></b>"; 
    
      ?> 
      </tbody>
      </table>
      
    </main>
	

			<?php


	$conn->close();
	?>
	<a target="_ " href="admin dashboard.php"><CENTER><input type="button" value="Back" class='close'><br><br></CENTER></a>


	</form>	
</body>
</html>


