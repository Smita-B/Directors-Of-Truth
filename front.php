<?php
    include("config.php");
    session_start();
    $REG_ID=$_SESSION['REG_ID'];
    $NAME=$_SESSION['NAME'];
    
    /*$name=$_SESSION['name'];
    $Email=$_SESSION['email'];
    $Username=$_SESSION['username'];
    $Password=$_SESSION['password'];*/
    $result=mysqli_query($conn,"select * from user_registration where REG_ID=$REG_ID");
    if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$reg=$row['REG_ID'];
				$name=$row['NAME'];
				$photo=$row["PHOTO"];
				$age=$row["AGE"];
			}
		}
		$result1=mysqli_query($conn,"SELECT COUNT(*) as Count FROM user_login");
		/*SELECT COUNT(DISTINCT id) as DAU
    FROM users
    WHERE date_joined > NOW() - INTERVAL 1 DAY*/
	$result1=mysqli_query($conn,"SELECT COUNT(DISTINCT USER_ID) as Count
   								 FROM user_login
    							 WHERE Time > NOW() - INTERVAL 1 DAY ");
    if ($result1->num_rows > 0) 
		{
			while($row = $result1->fetch_assoc())
			{
				$count=$row['Count'];
			}
		}
		$result2=mysqli_query($conn,"SELECT COUNT(*) as COUNT FROM complaint_status");
    if ($result1->num_rows > 0) 
		{
			while($row = $result2->fetch_assoc())
			{
				$count1=$row['COUNT'];
			}
		}
		$result4=mysqli_query($conn,"SELECT COUNT(*) as COUNT FROM missing_report");
    if ($result4->num_rows > 0) 
		{
			while($row = $result4->fetch_assoc())
			{
				$count2=$row['COUNT'];
			}
		}
	$REPORT_COUNT=$count1+$count2;
	$result5=mysqli_query($conn,"SELECT COUNT(*) as COUNT FROM missing_report WHERE STATUS NOT IN (SELECT STATUS FROM missing_report WHERE STATUS='MATCH FOUND')");
	if ($result5->num_rows > 0) 
	{
		while($row = $result5->fetch_assoc())
		{
			$Acount1=$row['COUNT'];
		}
	}
	$result6=mysqli_query($conn,"SELECT COUNT(*) as COUNT FROM complaint_status WHERE STATUS='ACTIVE' OR STATUS='UNATTENDED' ");
	if ($result6->num_rows > 0) 
	{
		while($row = $result6->fetch_assoc())
		{
			$Acount2=$row['COUNT'];
		}
	}

	$AREPORT_COUNT=$Acount1+$Acount2;


		$result3=mysqli_query($conn,"SELECT COUNT(*) as COUNT FROM feedback");
    if ($result3->num_rows > 0) 
		{
			while($row = $result3->fetch_assoc())
			{
				$counts=$row['COUNT'];
			}
		}
		/*$act=mysqli_query($conn,"SELECT COUNT(*) as ACT FROM complaint_status where STATUS='ACTIVE' ");
    	if ($act->num_rows > 0) 
		{
			while($row = $act->fetch_assoc())
			{
				$act=$row['ACT'];
			}
		}*/
		/*$sol=mysqli_query($conn,"SELECT COUNT(*) as SOL FROM complaint_status where STATUS='SOLVED' ");
    	if ($sol->num_rows > 0) 
		{
			while($row = $sol->fetch_assoc())
			{
				$sol=$row['SOL'];
			}
		}*/
		//$count=1;
		$_SESSION['REG_ID']=$REG_ID;
    	$_SESSION['NAME']=$NAME;
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="style.css">

<style type="text/css">
	    
.myPopup {
position: relative;
opacity:0;
-webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
}
.myPopup:target {
opacity:1;}
.myPopup > div {
width: 750px;
height: 420px;
position: relative;
margin: 10% auto;
padding: 5px 20px 13px 20px;
border-radius: 10px;
background: #71a6fc;
background: -moz-linear-gradient(#4f0a0c, #fff);
background: -webkit-linear-gradient(#999,#4f0a0c );
}
.close {
background: #606061;
color: #FFFFFF;
line-height: 25px;
position: absolute;
right: -12px;
text-align: center;
top: -10px;
width: 24px;
text-decoration: none;
-webkit-border-radius: 12px;
-moz-box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #00d9ff; 
}

.wrapper{
    width: 900px;
    margin: 5% auto;
}
.wrapper h2{
    text-transform: uppercase;
    font-family: poppins;
    font-weight: bold;
    text-align: center;
    font-size: 60px;
    color: #fff;
    margin: 0;
}
.single-service {
position: relative;
width: 24%;
height: 280px;
background: #fff;
box-sizing: border-box;
padding: 0 15px;
transition: .5s;
overflow: hidden;
float: left;
margin: 0 10px;
text-align: center;
}
.line {
width: 150px;
height: 3px;
background: #fff;

}
.single-service p{            
    color: #262626;
    font-size: 14px;
}
.single-service h3 {
    font-size: 25px;
    text-transform: uppercase;
    font-family: poppins;
    letter-spacing: 1px;
    color: #262626;
}
.social {
width: 60px;
height: 60px;
background: #262626;
border-radius: 50%;
margin: 5% auto;
}
.social i {
font-size: 30px;
padding: 15px;
    color: #fff;
}
.single-service:hover{
    box-shadow: 0 30px 35px rgba(0,0,0,0.7);
}
.single-service span {
position: absolute;
top: 0;
left: -110%;
width: 100%;
height: 100%;
background: rgba(0,0,0,0.7);
transition: .7s;
transform: skewX(10deg);
}
.single-service:hover span{
    left: 110%;
}

@media (max-width:1000px){
    .wrapper {
width: 100%;
}
.single-service {
width: 95%;
margin-bottom: 30px;
}
.wrapper h2 {
font-size: 30px;
}
}
th, td{
padding-top: 20px;
padding-bottom: 20px;
padding-left: 10px;
padding-right: 5px;
}
th
{
	background-color: #4f0a0c;

}
input[type=text]{
padding: 2px 2px;
margin: 4px 0;
box-sizing: border-box;
}
.tiles {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  -moz-column-gap: 1rem;
       column-gap: 1rem;
  row-gap: 1rem;
  margin-top: 1.25rem;
}


.tile {
  padding: 1rem;
  border-radius: 8px;
  background-color: var(--c-olive-500);
  color: var(--c-gray-900);
  min-height: 100px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  transition: 0.25s ease;
}
.tile:hover {
  transform: translateY(-5px);
}
.tile:focus-within {
  box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-olive-500);
}
.tile:nth-child(2) {
  background-color: var(--c-green-500);
}
.tile:nth-child(2):focus-within {
  box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-green-500);
}
.tile:nth-child(3) {
  background-color: var(--c-gray-300);
}
.tile:nth-child(3):focus-within {
  box-shadow: 0 0 0 2px var(--c-gray-800), 0 0 0 4px var(--c-gray-300);
}
.tile a {
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-weight: 100;
}
.tile a .icon-button {
  color: inherit;
  border-color: inherit;
}
.tile a .icon-button:hover, .tile a .icon-button:focus {
  background-color: transparent;
}
.tile a .icon-button:hover i, .tile a .icon-button:focus i {
  transform: none;
}
.tile a:focus {
  box-shadow: none;
}
.tile a:after {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.tile-header {
  display: flex;
  align-items: center;
}
.tile-header i {
  font-size: 2.5em;
}
.tile-header h3 {
  display: flex;
  flex-direction: column;
  line-height: 1.375;
  margin-left: 0.5rem;
}
.tile-header h3 span:first-child {
  font-weight: 400;
}
.tile-header h3 span:last-child {
  font-size: 0.825em;
  font-weight: 200;
}

.service-section > h2 {
  font-size: 1.5rem;
  margin-bottom: 1.25rem;
}

.service-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.service-section-header > * + * {
  margin-left: 1.25rem;
}
@media (max-width: 100px) {
  .service-section-header {
    display: none;
  }
}

.service-section-footer {
  color: var(--c-text-tertiary);
  margin-top: 1rem;
}

</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="app">
	<header class="app-header">
		<div class="app-header-logo">
			<div class="logo">
				<span class="logo-icon">
					<img src="https://assets.codepen.io/285131/almeria-logo.svg" />
				</span>
				<h1 class="logo-title">
					<span>DOT 1.0</span>
					<span>User Dashboard</span>
				</h1>
			</div>
		</div>
		<div class="app-header-navigation">
			<div class="tabs">
				<a href="#" class="active">
					Home
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#aboutPopup">
					About
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#servicesPopup">
					Services
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="Awareness.html">
					Awareness&nbsp;&nbsp;&nbsp;&nbsp;
				</a>
			</div>
		</div>

		<div class="app-header-actions">
			<button class="user-profile">
				<span><a href="profile1.php"><?php echo $name; ?></a></span>
				<span>
				<a href="profile1.php"><img src="<?php echo $photo; ?>"></a>
				</span>
			</button>
		</div>
		<div class="app-header-mobile">
			<button class="icon-button large">
				<i class="ph-list"></i>
			</button>
		</div>

	</header>
	<div class="app-body">
		<div class="app-body-navigation">
			<nav class="navigation">
				<a href="profile1.php">
					<i class="ph-browsers"></i>
					<span>User Profile</span>
				</a>
				<?php
					if(empty($age))
					{
						echo "<a href='multimissing.php'> <i class='fa fa-user'></i>
					<span>Complete registration</span>
				</a>";
					}
					else
					{
						echo "<a href='done2.php'>
					<i class='fa fa-user'></i>
					<span>Update registration</span>
				</a>";
					}
				?>
				<?php
					if(empty($age))
					{
						echo "<a href='multimissing.php'> <i class='ph-check-square'></i>
					<span>Lodge Complaints</span>
				</a>";
					}
					else
					{
						echo "<a href='menu.php'>
					<i class='ph-check-square'></i>
					<span>Lodge Complaints</span>
				</a>";
					}
				?>
				<a href="tenant_final.php">
					<i class="ph-swap"></i>
					<span>Identity Verification</span>
				</a>
				<a href="near_police.php">
					<i class="ph-file-text"></i>
					<span>Police station Details</span>
				</a>
				<a href="danger.php">
					<i class="fa fa-shield" aria-hidden="true"></i>
					<span>Location Security</span>
				</a>
				<a href="logout.php">
					<i class="ph-lock" aria-hidden="true"></i>
					<span>Logout</span>
				</a>
			</nav>
			<footer class="footer">
				
				<div>
					Directors Of Truth<br />
					All Rights Reserved 2023
				</div>
			</footer>
		</div>

		<div class="app-body-main-content">
			<section class="service-section">
				<h2>Home</h2>
				<div class="tiles">
					<article class="tile">
						<div class="tile-header">
							<i class="ph-lightning-light"></i>
							<h3>
								<span>Daily Views</span>
								<span>User Login: <?php echo "<b>" . $count . "</b>"; ?></span>
							</h3>
						</div>
					</article>
					<article class="tile">
						<div class="tile-header">
							<i class="ph-file-light"></i>
							<h3>
								<span>Reports lodged</span>
								<span>Total reports: <?php echo "<b>" . $REPORT_COUNT . "</b>"; ?></span>
								<span>Unresolved reports: <?php echo "<b>" . $AREPORT_COUNT . "</b>"; ?></span>
							</h3>
						</div>
					</article>
					<article class="tile">
						<div class="tile-header">
							<i class="ph-file-light"></i>
							<h3>
								<span>Total Feedbacks</span>
								<span> Submitted:<?php echo "<b>" . $counts . "</b>"; ?></span>
							</h3>
						</div>
					</article>
				</div>
				<div class="service-section-footer">
					<p>The official website of Directors Of Truth</p>
				</div>
			</section>
			<section class="transfer-section">
				<div class="transfer-section-header">
					<h2>Helpline Numbers</h2>
				</div>
				<div style="overflow-x:auto;">
  			<table>
  				<tr align="center" color="white">
    					<td><i class="fa fa-child fa-3x" aria-hidden="true"></i></td>
    					<td><i class="fa fa-volume-control-phone fa-3x" aria-hidden="true"></i></td>
    					<td><i class="fa fa-medkit fa-3x" aria-hidden="true"></i></td>
    					<td><i class="fa fa-wheelchair-alt fa-3x" aria-hidden="true"></i></td>
    					<td><i class="fa fa-car fa-3x" aria-hidden="true"></i></td>
    					<td><i class="fa fa-female fa-3x" aria-hidden="true"></i></td>
    				</tr>
    				<tr align="center">
    					<th>Child</th>
    					<th>Control Room</th>
    					<th>Medical</th>
    					<th>Disabled Citizen</th>
    					<th>Traffic</th>
    					<th>Women</th>
    				</tr>
    				<tr align="center">
    					<td>1098</td>
    					<td>100/1090</td>
    					<td>98300 79999</td>
    					<td>98300 88884</td>
    					<td>1073(Toll Free)<br>2000/2001</td>
    					<td>1091</td>
    				</tr>
  			</table>
				</div>
			</section>

		</div>
		<div>
			<font size="5px" color="white">Message</font><br><br>
	<marquee style="font-family: Book Antiqua; color: #FFFFFF" direction="up" height="350" ><p align="center">Dear Community,<br><br>

In the face of evolving challenges, the D.O.T team stands united to protect and empower you. We are committed to upholding justice, ensuring your safety, and preserving the truth. Through our advanced technologies and integrated systems, we strive to be your trusted ally in combating crime.<br><br>

Together, let us create a secure environment where trust thrives, collaboration prevails, and transparency reigns. We believe that by working hand in hand, we can build resilient communities that stand strong against any threat.<br><br>

Your safety is our priority, and we are dedicated to making a positive impact on your lives. Trust in us, and together, we will overcome challenges and forge a brighter future.<br><br>

Sincerely,<br>

The D.O.T Team</p></marquee>
</div>
	</div>
	<div id="aboutPopup" class="myPopup">
            <div>
                <a href="#close" title=" Close" class="close">X</a> 
                <center><div class="image">
                <img src="landimg/logos.png" height="100px" width="100px">
            		</div>
                <font color="yellow" size="6px">About Us</font>
				</center>
                <p>
                  At DOT website, We offer a range of powerful functionalities to address the challenges posed by criminal activities. Our cutting-edge technologies and integrated systems are designed to enhance law enforcement efforts and ensure the safety of communities.
				  We ensure swift discoveries of missing people. Our ID verification proves authenticity and protection against fraudsters. Danger predictor helps in providing crucial insights into potential risks and threats in specific areas.By streamlining workflows and providing real-time data, we provide improved operational efficiency for law enforcement agencies. Our transparent platform allows citizens to monitor case progress and check the status of their own cases, fostering trust and collaboration.
				  At D.O.T, we are committed to leveraging technology and innovation to combat crime effectively, ultimately creating safer communities.
				  </p>
				
            </div>
        </div>
    <div id="Awareness" class="myPopup">
            <div>
                <a href="#close" title=" Close" class="close">X</a> 
                
            </div>
        </div> 
   <div id="servicesPopup" class="myPopup">
            <div>
                <a href="#close" title=" Close" class="close">X</a> 
                <div class="wrapper">
  <font color="yellow" size="6px" align="right">Services</font>
<div class="line">
</div><br>
<div class="single-service">
      <div class="social">
<i class="fa fa-codepen"></i></div>
<span></span>
       <h3>
Complaint Lodge</h3>
<p>A complaint lodge system facilitates the submission, tracking, and resolution of complaints from customers, clients, or users.</p>
</div>
<div class="single-service">
      <div class="social">
<i class="fa fa-cogs"></i></div>
<span></span>
       <h3>
Face Recognition</h3>
<p>The system confirms if the provided face matches the template of a specific individual. In identification mode, the system searches a database to determine the person's identity by finding the closest match.
                    </p>
				</div>
<div class="single-service">
      <div class="social">
<i class="fa fa-diamond"></i></div>
<span></span>
       <h3>
Location Security</h3>
<p>Displays the approximate danger level of a given police station from the city of Kolkata.</p>
</div>
</div>
            </div>
        </div>

</div>


<!-- partial -->
  <script src='https://unpkg.com/phosphor-icons'></script><script  src="js/script.js"></script>
</body>
</html>
