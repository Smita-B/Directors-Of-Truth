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
/*$id=$_SESSION['id'];
$name=$_SESSION['name'];                  
$photoname=$_SESSION['photo'];*/
    
    //post method to pass variables from html code to php in a page
    //post method to pass variables from html code to php in a page
    
$conn->close();

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="GD.css">
    <style type="text/css">
      body {
  text-align: center;
  background-color: #fffaae;
}

h1 {
  font-size: 30px;
}

p {
  font-size: 22px;
}

.form-rows {
  position: static;
  display: block;
}

.master-div-style {
  margin: auto;
  width: 800px;
  background-color: #f3f3f3;
  box-shadow: -5px -5px 25px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.35),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    inset 5px 5px 15px rgba(0, 0, 0, 0.35);
  border-radius: 10px;
  padding: 20px 10px 10px 10px;
}

.fields {
  display: inline-block;
  text-align: left;
  width: 48%;
  vertical-align: middle;
}
.labels {
  display: inline-block;
  text-align: right;
  width: 40%;
  padding: 5px;
  vertical-align: top;
  margin-top: 10px;
}

.input-fields {
  height: 20px;
  width: 280px;
  padding: 5px;
  margin: 10px;
  border: 1px solid #c0c0c0;
  border-radius: 4px;
}

.dropdown {
  height: 35px;
  width: 140px;
  padding: 5px;
  margin: 15px 10px 10px 10px;
  border: 1px solid #c0c0c0;
  border-radius: 4px;
}

.dates {
  height: 20px;
  width: 140px;
  padding: 5px;
  margin: 15px 10px 10px 10px;
  border: 1px solid #c0c0c0;
  border-radius: 4px;
}

.button {
  font-size: 1em;
  background-color: #69ad5b;
  color: white;
  border: 0px solid;
  border-radius: 4px;
  height: 40px;
  width: 80px;
  margin: 10px;
}

@media (max-width: 833px) {
  .master-div-style {
    width: 70%;
  }

  .fields {
    display: inline-block;
    text-align: left;
    width: 48%;
    vertical-align: middle;
  }

  .input-fields {
    width: 80%;
  }

  .dropdown {
    width: 90%;
  }

  .dates {
    width: 90%;
  }
}

@media (max-width: 520px) {
  .master-div-style {
    width: 80%;
  }

  .fields {
    width: 80%;
    float: left;
  }
  .labels {
    width: 100%;
    text-align: left;
  }

  .input-fields {
    width: 100%;
  }

  .dropdown {
    width: 100%;
  }
  .dates{
     width: 100%;
  }
}

    </style>
  </head>
<body>
  <main>
    <h1 id="title">Missing Report</h1>
    <div class="master-div-style">
      <p id="description">Fields marked with an <font color="red">*</font> are required</p>
      <form id="survey-form" action="missing_submitted.php" method="POST" enctype="multipart/form-data">
        <div class="form-rows">
          <div class="labels">
            <label for="name" id="name-label"><b>Name of the missing person</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" name="n1" id="t1"  size="30" maxlength="100" minlength="2" title="Enter name" placeholder="Enter missing person name here" class="input-fields" required >
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="details" id="email-label"><b>Age</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="number" name="n3" id="t3" maxlength="100" minlength="1" size="5"title="Enter age here"placeholder="Missing person's age" class="input-fields" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="details" id="email-label"><b>Features of missing person</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" name="feature" maxlength="1000" id="t4" size="30" placeholder="Features like height,weight etc" class="input-fields" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dropdown" id="dropdown-label"><b>Gender</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <select name="n6" id="dropdown" class="dropdown">
                <option value selected="selected">Select</option>  
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
        <div class="form-rows">
          <div class="labels">
            <label for="text" id="number-label"><b>Relationship with applicant</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" name="n4" maxlength="1000" id="t4" size="30" placeholder="Relationship of missing person with applicant" class="input-fields" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="number" id="number-label"><b>Mobile No</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" pattern="[+]{1}[0-9]{2}[0-9]{5}[0-9]{5}" name="n5" maxlength="13" minlength="13"id="t5" size="30" title="Enter your mobile no."placeholder="Mobile No." class="input-fields" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="email" id="email-label"><b>Email ID</b></label>
          </div>
          <div class="fields">
            <input type="email" name="n7" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="t7" size="30" title="Enter your email id" class="input-fields" placeholder="Email Id">
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="photo" id="email-label"><b>Upload misssing person photo</b></label>
          </div>
          <div class="fields">
            <input type="file" name="upload[]" multiple id="Upload" accept="image/png, image/gif, image/jpeg" class="input-fields" required>         
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="location" id="email-label"><b>Last location</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" id="location" class="input-fields" name="n8" maxlength="1000" id="t8" size="30" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dates" id="email-label"><b>Date and time(Last seen)</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="DATE" name="n9" id="t9" id="dates" class="dates" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dates" id="email-label"><b>Time</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="TIME" name="n19" id="t9" id="dates" class="dates" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dropdown" id="dropdown-label"><b>Police station name</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <select id="ps1" name="ps" placeholder="Choose police station" class="dropdown" size="1">
                <option value selected="selected">Select</option>  
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
            </select>
          </div>
        </div>
        
        <button class="button" id="submit" type="submit">Submit</button>
        <button class="button" id="reset" type="reset" value="Reset" name="reset">Reset</button>
      </form>
    </div>
  </main>
</body>

</html>