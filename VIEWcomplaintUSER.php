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

$fn=$_GET['fn'];
//$fn='57667929';
$table=$_GET['table'];
$REG_ID=$_SESSION['REG_ID'];
//$REG_ID='2023';
$_SESSION['REG_ID']=$REG_ID;
//$table='FIR_DETAILS';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Login & Registration Page</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
body {
  font-family: Roboto, sans-serif;
  margin: 0;
  height: 100vh;
  display: grid;
  align-items: center;
  justify-items: center;
  background-image: linear-gradient(to top, #e3d9db,#e3d9db);
}

.card {
  background: #fff;
  border-radius: 4px;
  box-shadow: 0px 14px 80px rgba(44, 2, 3, 0.5);
  max-width: 700px;
  display: flex;
  flex-direction: row;
  border-radius: 25px;
  position: relative;
}

.card h2 {
  margin: 0;
  padding: 0 1rem;
}

.card .title {
  padding: 1rem;
  text-align: right;
  color: green;
  font-weight: bold;
  font-size: 12px;
}

.card .desc {
  padding: 0.5rem 1rem;
  font-size: 12px;
}

.card .actions {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  align-items: center;
  padding: 0.5rem 1rem;
}

.card svg {
  width: 85px;
  height: 85px;
  margin: 0 auto;
}

.img-avatar {
  width: 80px;
  height: 80px;
  position: absolute;
  border-radius: 50%;
  border: 6px solid white;
  background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
  top: 15px;
  left: 85px;
}

.card-text {
  display: grid;
  grid-template-columns: 1fr 2fr;
}

.title-total {
  padding: 2.5em 1.5em 1.5em 1.5em;
}

path {
  fill: white;
}

.img-portada {
  width: 100%;
}

.portada {
  width: 100%;
  height: 100%;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  background-position: bottom center;
  background-size: cover;
}

.close {
        background-color: #410613;
        border: none;
        color: white;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
      }

td{
  width: 800px;
  font-family: sans-serif;
  font-size: 15px;
}
    </style>
</head>
<body>

  <!--FIR show-->

<?php
  if ($table=="FIR_DETAILS")
  {
    $result=mysqli_query($conn,"SELECT * FROM FIR_DETAILS WHERE FIR_NO=$fn ");
    $row = $result->fetch_assoc();
    ?>
    <div class="card">
        <div class="card-text">
            <div class="portada" style="background-color: black;">
                <center><img src="FIR.jpeg" height="150px" width="150px" style="border-radius: 180px;"><br><br><br>
                <font color="white" size="4px">FIR Number</font><br>
                <font color="white"><b><?php echo $fn; ?></b></center></font>
            </div>
        <div class="title-total">   
            <h2>Complaint Details</h2><br>
            <div class="desc">
              <table>
              <tr>
                <td>REG ID: </td>
                <td><b><font color="#6c030b"><?php echo $row['REG_ID'] ?></font></b></td>
              </tr>
              <tr>
                <td>INCIDENT REPORTED: </td>
                <td><b><font color="#6c030b"><?php echo $row['CrimeName'] ?></font></b></td>
              </tr>
              <tr>
                <td>ACCUSED PERSON: </td>
                <td><b><font color="#6c030b">
                  <?php 
                    if(empty($row['AccusedPerson']))
                      echo "NA";
                    else
                      echo $row['AccusedPerson'];
                  ?></font></b></td>
              </tr>
              <tr>
                <td>CRIME DETAILS: </td>
                <td><b><font color="#6c030b"><?php echo $row['Crime_details'] ?></font></b></td>
              </tr>
              <tr>
                <td>LOCATION: </td>
                <td><b><font color="#6c030b"><?php echo $row['Location'] ?></font></b></td>
              </tr>
              <tr>
                <td>PSNAME: </td>
                <td><b><font color="#6c030b"><?php echo $row['PSNAME'] ?></font></b></td>
              </tr>
              <tr>
                <td>DATE: </td>
                <td><b><font color="#6c030b"><?php echo $row['DATE'] ?></font></b></td>
              </tr>
            </table>
            </div>
        </div>
    </div>
  </center>
</div>
    <?php
  }
  ?>

  <!--GD Show-->

<?php
  if ($table=="GD_DETAILS")
  {
    $result=mysqli_query($conn,"SELECT * FROM GD_DETAILS WHERE  GD_NO=$fn ");
    $row = $result->fetch_assoc();
    ?>
    <div class="card">
        <div class="card-text">
            <div class="portada" style="background-color: black;">
                <center><img src="gds.jpg" height="160px" width="150px" style="border-radius: 180px;"><br><br><br>
                <font color="white" size="4px">GD Number </font><br>
                <font color="white"><b><?php echo $fn; ?></b></center></font>
            </div>
        <div class="title-total">   
            <h2>Complaint Details</h2><br>
            <div class="desc">
              <table>
              <tr>
                <td>REG ID: </td>
                <td><b><font color="#6c030b"><?php echo $row['REG_ID'] ?></font></b></td>
              </tr>
              <tr>
                <td>OBJECT NAME: </td>
                <td><b><font color="#6c030b"><?php echo $row['ObjectName'] ?></font></b></td>
              </tr>
              <tr>
                <td>OBJECT DETAILS: </td>
                <td><b><font color="#6c030b"><?php echo $row['Object_details'] ?></font></b></td>
              </tr>
              <tr>
                <td>PSNAME: </td>
                <td><b><font color="#6c030b"><?php echo $row['PSNAME'] ?></font></b></td>
              </tr>
              <tr>
                <td>DATE & TIME: </td>
                <td><b><font color="#6c030b"><?php echo $row['DATETIME'] ?></font></b></td>
              </tr>
            </table>
            </div>
        </div>
    </div>
  </center>
</div>
    <?php
  }
  ?>

<!--Missing Show-->

<?php
  if ($table=="MISSING_REPORT")
  {
    $result=mysqli_query($conn,"SELECT * FROM MISSING_REPORT WHERE  M_ID=$fn ");
    $row = $result->fetch_assoc();
    $PHOTO=$row['PHOTO'];
    ?>
    <div class="card">
        <div class="card-text">
            <div class="portada" style="background-color: black;">
                <center><img src="missing.jpg" height="170px" width="150px" style="border-radius: 180px;"><br><br><br>
                <font color="white" size="4px">MISSING ID</font><br>
                <font color="white"><b><?php echo $fn; ?></b></center></font>
            </div>
        <div class="title-total">   
            <h2>Complaint Details</h2><br>
            <div class="desc">
              <table>
              <tr>
                <td>REG ID: </td>
                <td><b><font color="#6c030b"><?php echo $row['REG_ID'] ?></font></b></td>
              </tr>
              <tr>
                <td>MISSING PERSON NAME: </td>
                <td><b><font color="#6c030b"><?php echo $row['M_NAME'] ?></font></b></td>
              </tr>
              <tr>
                <td>PHOTO: </td>
                <td><b><font color="#6c030b"><img src="<?php echo $PHOTO  ?>" height="50" width="50" alt=$PHOTO ></font></b></td>
              </tr>
              <tr>
                <td>GENDER: </td>
                <td><b><font color="#6c030b"><?php echo $row['GENDER'] ?></font></b></td>
              </tr>
              <tr>
                <td>AGE: </td>
                <td><b><font color="#6c030b"><?php echo $row['AGE'] ?></font></b></td>
              </tr>
              <tr>
                <td>FEATURE: </td>
                <td><b><font color="#6c030b"><?php echo $row['FEATURE'] ?></font></b></td>
              </tr>
              <tr>
                <td>LOCATION: </td>
                <td><b><font color="#6c030b"><?php echo $row['LOCATION'] ?></font></b></td>
              </tr>
              <tr>
                <td>PSNAME: </td>
                <td><b><font color="#6c030b"><?php echo $row['PSNAME'] ?></font></b></td>
              </tr>
              <tr>
                <td>DATE: </td>
                <td><b><font color="#6c030b"><?php echo $row['DATE'] ?></font></b></td>
              </tr>
              <tr>
                <td>TIME: </td>
                <td><b><font color="#6c030b"><?php echo $row['TIME'] ?></font></b></td>
              </tr>
            </table>
            </div>
        </div>
    </div>
  </center>
</div>
    <?php
  }
  ?>

  <a href="UserComplaintUPDATE1.php?attribute=ERROR" class="close"><center>Back</center></a>
</body>
</html>