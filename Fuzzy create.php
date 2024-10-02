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
else
{
	echo "connected successfully";

}
echo "<br>";
$sql="CREATE TABLE Fuzzy
	(comment VARCHAR(300),
	 crime FLOAT(5),
	 ccrime VARCHAR(300),
	 report FLOAT(5),
	 creport VARCHAR(300),
	 missing FLOAT(5),
	 cmissing VARCHAR(300),
	 pdanger FLOAT(5),
	 cpdanger VARCHAR(300),
	 danger FLOAT(10),
	 PSNAME VARCHAR(50) NOT NULL,
	 PRIMARY KEY(PSNAME),
	 FOREIGN KEY (PSNAME) REFERENCES POLICE_RECORD(PSNAME) ON DELETE CASCADE
	)";

if($conn->query($sql)===TRUE)
{
	echo"TABLE Fuzzy CREATED SUCCESSFULLY";
}
else
{
	echo"Error :".$conn->error;
}

$conn->close();
?>