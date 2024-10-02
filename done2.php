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
$REG_ID=$_SESSION['REG_ID'];
$NAME=$_SESSION['NAME'];     

$_SESSION['NAME']=$NAME;
$_SESSION['REG_ID']=$REG_ID;
$conn->close();
?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h3 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 30px;
          margin-bottom: 10px;
        }
        p {
          color: black;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
        h4{
          color: black;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
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
        padding: 8px 18px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
      }
      .open-button {
  background-color: #222;
  color: white;
  padding: 8px 18px;
}
    </style>
    <body>
      <div class="card">
      
        <h3>You are already registerd</h3><br/>
        <p><b>Want to update your phone number?</b><br><br></p>
        <form action="update.php" method="POST">
        <CENTER><input type="submit" value="Update Phone number" class="open-button" style="cursor: pointer;"></CENTER>
        </form> 
        <font color="#2d0104"><b>OR</b></font><br><br><h4>Go to the main page.</h4>
        <br>
        <a href="front.php" class="button">Menu</a>
      </div>
    </body>
</html>