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
	VALUES ('Shyampukur');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Jorabagan');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Burtolla');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Burrabazar');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Posta');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Jorasanko');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Girish Park');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Amherst Street');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Hare Street');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Bowbazar');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Muchipara');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Taltala');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('New Market');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Park Street');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Ultadanga Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Tollygunge Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Behala Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Karaya Women');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Shakespeare Sarani');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Entally');";


$sql.=" INSERT INTO Fuzzy ( PSNAME)
	VALUES ('Topsia');";




if ($conn->multi_query($sql)===TRUE)
{
	echo" Data inserted successfully";
}
else
{
	echo"Error :". $sql . "<br>" . $conn->error;
}
