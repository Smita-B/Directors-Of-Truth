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

    
    
$conn->close();

?>


<html>
<head>
<title> File FIR </title>
 <link rel="stylesheet" type="text/css" href="GD.css">
 <style type="text/css">
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
 </style>
</head>
<body>
<form action="FIR_SUBMITTED-1.php" method="POST" enctype="multipart/form-data"> <!-- LINK TO PAGE FOR REDIRECTION -->

  <main>
    <h1 id="title">First Information Report (FIR)</h1>
    <div class="master-div-style">
      <p id="description">Fields marked with an <font color="red">*</font> are required</p>
      <div class="form-rows">
          <div class="labels">
            <label for="dropdown" id="dropdown-label"><b>Select Crime</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <select name="crime" id="dropdown" class="dropdown" size="1" required>
<option value selected="select" >----------------------------------Select----------------------------------</option>
<optgroup label="Crime" style="font-style: italic ;" >
<option value="Accident">Accident</option>
<option value="Child Labour">Child Labour</option>
<option value="Dowry Act">Dowry Act</option>
<option value="Eve Teasing">Eve Teasing</option>
<option value="Extortion">Extortion</option>                                        
<option value="Gambling Act">Gambling Act</option>
<option value="Kidnapping">Kidnapping</option>
<option value="Loot">Loot</option>
<option value="Murder">Murder</option>
<option value="Ransom">Ransom</option>
<option value="Rape">Rape</option>
<option value="Riot">Riot</option>
<option value="Robbery">Robbery</option>
<option value="Swindle">Swindle</option>
<option value="Theft">Theft</option>
<option value="Witch Act">Witch Act</option>
<option value="Tortured">Torture</option>


<option value="Domestic Violence">Domestic Violence</option> 
<option value="Bullying">Bullying</option>
<option value="Fraud">Fraud</option>
<option value="Smuggling">Smuggling</option>
<option value="Protection racketeering">Protection racketeering</option>
<option value="Loan sharking">Loan sharking</option>
<option value="Drug-trafficking">Drug-trafficking</option>
<option value="Terrorism">Terrorism</option>
<option value="Organized Riot">Organized Riot</option>


</optgroup>
<optgroup label="Cyber Crime" style="font-style: italic ;">

             <option value="Mobile Lost/Theft" >Mobile Lost/Theft</option>
             <option value="Hacking" >Hacking</option>
             <option value="Theft (of copyright/videos/music/patent/trademark etc.)" >Theft (of copyright/videos/music/patent/trademark etc.)</option>
             <option value="Cyber Stalking" >Cyber Stalking</option>
             <option value="Identity Theft" >Identity Theft</option>
             <option value="Malicious Software">Malicious Software</option>
             <option value="Child soliciting and Abuse" >Child soliciting and Abuse</option>
                    <optgroup label="Online Defamation" style="font-style: italic ;" >
                        <option value="Threat to life" >Threat to life</option>
                        <option value="Demand of Ransom" >Demand of Ransom</option>
                        <option value="Posting vulgar content" >Posting vulgar content</option>

                    </optgroup>
</optgroup>
<optgroup label="Property" style="font-style: italic;">
             <option value="Credit card and debit card fraud" >Credit card and debit card fraud</option>
             <option value="Email scams and fake websites"  >Email scams and fake websites</option>
             <option value="Pension Fraud"  >Pension Fraud</option>
             <option value="Card Fraud Telephone Scam"  >Card Fraud Telephone Scam</option>
         </optgroup>
         <optgroup label="Government" style="font-style: italic;">
             <option value="Phishing"  >Phishing</option>
             <option value="Cyber Terrorism"  >Cyber Terrorism</option>
             <option value="Reporting of Fake Government Websites"  >Reporting of Fake Government Websites</option>
         </optgroup>
         <optgroup label="Others" style="font-style: italic;">
             <option value="Others"  >Others</option  >
         </optgroup>
     </select>
 </div>
        <div class="form-rows">
          <div class="labels">
            <label for="details" id="email-label"><b>Name and Address of accused person</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <textarea id="event-details" class="input-fields" style="height: 50px;resize:vertical;font-family: Open Sans Condensed;" name="accused"
placeholder="Name and details of accused person "></textarea>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="details" id="email-label"><b>Crime Details</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <textarea id="event-details" class="input-fields" style="height: 50px;resize:vertical;font-family: Open Sans Condensed;" name="cdetails"
placeholder="Details of crime "></textarea>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="number" id="number-label"><b>Mobile No</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="number" id="number" class="input-fields" pattern="[+]{1}[0-9]{2}[0-9]{5}[0-9]{5}" placeholder="Enter your mobile no." name="mobile">
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="email" id="email-label"><b>Email Id</b></label>
          </div>
          <div class="fields">
            <input type="email" id="email" class="input-fields" placeholder="Enter your email address" name="email" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="location" id="email-label"><b>Location</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text" id="location" class="input-fields" placeholder="Enter the location" name="location" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dates" id="email-label"><b>Date of crime</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="date" name="dates" id="dates" class="dates" required>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dropdown" id="dropdown-label"><b>Police station name</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <select name="ps" id="dropdown" class="dropdown">
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

</form>
</body>
</html>

