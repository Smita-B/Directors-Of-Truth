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
	VALUES ('Alipore');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Sarsuna');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Hastings');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Maidan');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Cossipore');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Chitpur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('North Port');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Manicktala');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Ultadanga');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Beliaghata');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Phoolbagan');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Narkeldanga');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Patuli Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Rabindra Sarobar');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Amherst Street Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Tangra');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Beniapukur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Ballygunge');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Gariahat');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('South Port');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Tala');";




if ($conn->multi_query($sql)===TRUE)
{
	echo" Data inserted successfully";
}
else
{
	echo"Error :". $sql . "<br>" . $conn->error;
}
