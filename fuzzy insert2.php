<?php

$servername="localhost";
$username="root";
$password="";
$dbname="POLICE";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

//insert data into student

$sql=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Panchasayar');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Bhowanipur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Kalighat');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Tollygunge');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Lake');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Charu Market');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('New Alipore');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Watgunge');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('West Port');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Survey Park Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Garden Reach');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Taratala');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Karaya');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Ekbalpur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Sinthee');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Chetla');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Behala');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Netaji Nagar');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Kolkata Leather Complex');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Golf Green');";







if ($conn->multi_query($sql)===TRUE)
{
	echo" Data inserted successfully";
}
else
{
	echo"Error :". $sql . "<br>" . $conn->error;
}
