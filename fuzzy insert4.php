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
	VALUES ('Parnashree');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Thakurpukur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Jadavpur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Kasba');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Purba Jadavpur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Nadial');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Rajabagan');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Pragati Maidan');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Haridevpur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Regent Park');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Survey Park');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Bansdroni');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Garfa');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Patuli');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Metiabruz');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Tiljala');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Anandapur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Taltala Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Watgunge Women');";



if ($conn->multi_query($sql)===TRUE)
{
	echo" Data inserted successfully";
}
else
{
	echo"Error :". $sql . "<br>" . $conn->error;
}
