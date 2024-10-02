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
  <title>Show Cases</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sign.css">
    <style type="text/css">
       *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Baskerville Old Face', sans-serif;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(back2.jpg);
    background-size: cover;
}
.container{
    padding: 40px;
    border-radius: 20px;
    border: 8px solid  #35020d;
    box-shadow: -5px -5px 25px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    inset 5px 5px 15px rgba(0, 0, 0, 0.35);
}
.container .form{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 25px;
}
.container .form.signin,
.container.signinForm .form.signup{
    display: none;
}
.container.signinForm .form.signin{
    display: flex;
}
.container .form h2{
    color: white;
    font-weight: 500;
    letter-spacing: 0.1em;
}
.container .form .inputBox{
    position: relative;
    width: 300px;
}

.container .form .inputBox input{
    padding: 12px 10px 12px 48px;
    border: none;
    width: 100%;
    background: black;
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: white;
    font-weight: 300;
    border-radius: 25px;
    font-size: 1em;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35);
    transition: 0.5s;
    outline: none;
}
.container .form .buttonBox input{
    padding: 8px 8px 8px 38px;
    border: none;
    width: 100%;
    background: black;
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: white;
    font-weight: 300;
    border-radius: 25px;
    font-size: 1em;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35);
    transition: 0.5s;
    outline: none;
}
.container .form .inputBox span{
    position: absolute;
    left: 0;
    padding: 12px 10px 12px 48px;
    pointer-events: none;
    font-size: 1em;
    font-weight: 300;
    transition: 0.5s;
    letter-spacing: 0.05em;
    color: rgba(255, 255, 255, 0.5);
}
.container .form .inputBox input:valid ~ span,
.container .form .inputBox input:focus ~ span{
    color: red;
    border: 1px solid red;
    background: black;
    transform: translateX(25px) translateY(-7px);
    font-size: 0.6em;
    padding: 0 8px;
    border-radius: 10px;
    letter-spacing: 0.1em;
}
.container .form .inputBox input:valid,
.container .form .inputBox input:focus{
    border: 1px solid rgb(23, 21, 21);
}

.container .form .inputBox i{
    position: absolute;
    top: 15px;
    left: 16px;
    width: 25px;
    padding: 2px 0;
    padding-right: 8px;
    color: Red;
    border-right: 1px solid red;
}
.container .form .inputBox input[type="submit"]
{
    background: #133605;
    color: rgb(249, 244, 244);
    padding: 10px 0;
    font-weight: 500;
    cursor: pointer;
    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    inset 5px 5px 15px rgba(0, 0, 0, 0.35);
}
.container .form p{
    color: rgba(255, 255, 255, 0.5);
    font-size: 1em;
    font-weight: 300;
}
.container .form p a{
    font-weight: 700;
    color: white;
}
.button
{
    background-color: black;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 15px 15px;
    font-size: 15px;
    cursor: pointer;
}
    </style>
</head>
<body>
  <div class="container">
	<form action='ViewComplaints.php' method="POST">
    <div class="form signup">
            <h2>Choose what to show by</h2>
	<!-- DROPDOWN FOR SELECTING THE ATTRIBUTE BY WHICH WANT TO FETCH COMPLAINTS-->	
	<select name="attribute" id="myCheck" onclick="myFunction()" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;">
		<option value selected="selected">------------Select------------</option>
  		<option value="PSNAME">PS NAME</option>
  		<option value="C_ID">COMPLAINT ID</option>
	</select>
	<table ><tr>

	<td id="text" class="txt" style="text-align: center; padding-bottom: 20px;"> <h2>Police Station Name</h2><select  name="ps" placeholder="Choose police station" size="1" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;">
    <option value selected="selected">------------Select------------</option>
	<option value="Alipore">Alipore</option>
    <option value="Amherst Street">Amherst Street</option>
    <option value="Amherst Street Women">Amherst Street Women</option>
    <option value="Anandapur">Anandapur</option>
    <option value="Ballygunge">Ballygunge</option>
    <option value="Bansdroni">Bansdroni</option>
    <option value="Behala">Behala</option>
    <option value="Behala Women">Behala Women</option>
    <option value="Beliaghata">Beliaghata</option>
    <option value="Beniapukur">Beniapukur</option>
    <option value="Bhowanipur">Bhowanipur</option>
    <option value="Bowbazar">Bowbazar</option>
    <option value="Burrabazar">Burrabazar</option>
    <option value="Burtolla">Burtolla</option>
    <option value="Charu Market">Charu Market</option>
    <option value="Chetla">Chetla</option>
    <option value="Chitpur">Chitpur</option>
    <option value="Cossipore">Cossipore</option>
    <option value="Ekbalpur">Ekbalpur</option>
    <option value="Entally">Entally</option>
    <option value="Garden Reach">Garden Reach</option>
    <option value="Garfa">Garfa</option>
    <option value="Gariahat">Gariahat</option>
    <option value="Girish Park">Girish Park</option>
    <option value="Golf Green">Golf Green</option>
    <option value="Hare Street">Hare Street</option>
    <option value="Haridevpur">Haridevpur</option>
    <option value="Hastings">Hastings</option>
    <option value="Jadavpur">Jadavpur</option>
    <option value="Jorabagan">Jorabagan</option>
    <option value="Jorasanko">Jorasanko</option>
    <option value="Kalighat">Kalighat</option>
    <option value="Karaya">Karaya</option>
    <option value="Karaya Women">Karaya Women</option>
    <option value="Kasba">Kasba</option>
    <option value="Kolkata Leather Complex">Kolkata Leather Complex</option>
    <option value="Lake">Lake</option>
    <option value="Maidan">Maidan</option>
    <option value="Manicktala">Manicktala</option>
    <option value="Metiabruz">Metiabruz</option>
    <option value="Muchipara">Muchipara</option>
    <option value="Nadial">Nadial</option>
    <option value="Narkeldanga">Narkeldanga</option>
    <option value="Netaji Nagar">Netaji Nagar</option>
    <option value="New Alipore">New Alipore</option>
    <option value="New Market">New Market</option>
    <option value="North Port">North Port</option>
    <option value="Panchasayar">Panchasayar</option>
    <option value="Park Street">Park Street</option>
    <option value="Parnashree">Parnashree</option>
    <option value="Patuli">Patuli</option>
    <option value="Patuli Women">Patuli Women</option>
    <option value="Phoolbagan">Phoolbagan</option>
    <option value="Posta">Posta</option>
    <option value="Pragati Maidan">Pragati Maidan</option>
    <option value="Purba Jadavpur">Purba Jadavpur</option>
    <option value="Rabindra Sarobar">Rabindra Sarobar</option>
    <option value="Rajabagan">Rajabagan</option>
    <option value="Regent Park">Regent Park</option>
    <option value="Sarsuna">Sarsuna</option>
    <option value="Shakespeare Sarani">Shakespeare Sarani</option>
    <option value="Shyampukur">Shyampukur</option>
    <option value="Sinthee">Sinthee</option>
    <option value="South Port">South Port</option>
    <option value="Survey Park">Survey Park</option>
    <option value="Survey Park Women">Survey Park Women</option>
    <option value="Tala">Tala</option>
    <option value="Taltala">Taltala</option>
    <option value="Taltala Women">Taltala Women</option>
    <option value="Tangra">Tangra</option>
    <option value="Taratala">Taratala</option>
    <option value="Thakurpukur">Thakurpukur</option>
    <option value="Tiljala">Tiljala</option>
    <option value="Tollygunge">Tollygunge</option>
    <option value="Tollygunge Women">Tollygunge Women</option>
    <option value="Topsia">Topsia</option>
    <option value="Ultadanga">Ultadanga</option>
    <option value="Ultadanga Women">Ultadanga Women</option>
    <option value="Watgunge">Watgunge</option>
    <option value="Watgunge Women">Watgunge Women</option>
    <option value="West Port">West Port</option>
  </select></td></tr>
  
	<td id="text1" class="txt" style="text-align: center; padding-bottom: 20px;"> <h2>Complaint No</h2><input type="text" name="cid" style="width:150px;height: 30px; background-color: #fef674; border-radius:40px;"></td></tr>
	</table >
  <div class="inputBox">
	<input type="submit" name="submit">
</div>
<a target="_ " href="admin dashboard.php"><CENTER><input type="button" value="Back" class="button"></a>
    </CENTER>
	<?php
	$conn->close();
	?>


	</form>	
</div>
</body>
</html>

<script>
function myFunction() {
  // Get the checkbox
  var val = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");
  var text1 = document.getElementById("text1");
  // If the checkbox is checked, display the output text
  if (val.value == "PSNAME"){
    text.style.display = "block";
  }
  else {
     text.style.display = "none";
  } 
  if(val.value == "C_ID") 
  {
    text1.style.display = "block";
  }
  else {
     text1.style.display = "none";
  }
}


</script>