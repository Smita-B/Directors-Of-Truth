<?php
	include("config.php");
    session_start();
	$REG_ID=$_SESSION['REG_ID'];
?>
<!DOCTYPE html>
<html>
<header>
  <link rel="stylesheet" type="text/css" href="GD.css">
</header>

<body>
  <main>
    <h1 id="title">Identity Verification</h1>
    <div class="master-div-style">
      <p id="description">Fields marked with an <font color="red">*</font> are required</p>
      <form id="survey-form" action="Tenant1.php" enctype="multipart/form-data" method="POST">
        <div class="form-rows">
          <div class="labels">
            <label for="name" id="name-label"><b>Name</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text"
                    id="fullName"
                    name="fullName"
                    placeholder="Enter Full Name" 
                    class="input-fields" value="" required />
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="photoid" id="name-label"><b>Photo Id Type:</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text"
                    id="photoidtype"
                    name="photoidtype"
                    placeholder="Enter Photoid Type" 
                    class="input-fields" value="" required/>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="photoid" id="name-label"><b>Photo Id No</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text"
                    id="photoid"
                    name="photoid"
                    placeholder="Enter Photoid Card no" 
                    class="input-fields" value="" required/>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="dropdown" id="dropdown-label"><b>Gender</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <select name="gender" id="dropdown" class="dropdown">
                <option value selected="selected">Select</option>  
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option> required
            </select>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="details" id="email-label"><b>Features</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="text"
                    id="fathername"
                    name="fathername"
                    placeholder="Enter features" 
                    class="input-fields" value="" required/>
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="email" id="email-label"><b>Address</b></label>
          </div>
          <div class="fields">
            <input type="text"
                    id="phoneNumber"
                    name="address"
                    placeholder="Enter Address" 
                    class="input-fields" value="" />
          </div>
        </div>
        <div class="form-rows">
          <div class="labels">
            <label for="photo" id="email-label"><b>Upload photo</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="file" name="upload[]" multiple id="Upload" accept="image/png, image/jpg, image/jpeg" required class="input-fields">      
          </div>
        </div>
        
        <div class="form-rows">
          <div class="labels">
            <label for="dates" id="email-label"><b>Date and time of Verification</b><font color="red">*</font></label>
          </div>
          <div class="fields">
            <input type="datetime-local" name="dates" id="dates" required class="dates">
          </div>
        </div>
        <input type="submit" value="Submit"name="submits" class="button" >
        <input type="reset" value="Reset" name="reset" class="button">
      </form>
    </div>
  </main>
</body>

</html>