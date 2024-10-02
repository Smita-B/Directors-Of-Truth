<?php
    include("config.php");
    session_start();
    $REG_ID=$_SESSION['REG_ID'];
    if (isset($_POST['submit'])) 
    {

        //echo $username;
        $mobile=$_POST['mobile'];
        //echo $mobile;
        //$result = "UPDATE user_registration SET PHONE='$mobile' WHERE USERNAME=' " . $username . "'";
        $result=mysqli_query($conn,"UPDATE user_registration SET PHONE='" . $_POST['mobile'] . "' WHERE REG_ID = ' " . $REG_ID . " ' ");
        if ($result) 
        {
            echo 
                    "
                        <script> 
                            alert('Mobile number is updated successfully'); 
                            document.location.href='profile1.php';
                        </script>
                    ";
        }
    }
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Phone No change Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="container">
        <form action='' method="POST">
        <div class="form signup">
            <h2>Update Phone Number</h2>
            <div class="inputBox">
            <input type="text" pattern="[+]{1}[0-9]{2}[0-9]{5}[0-9]{5}" name="mobile" maxlength="15" minlength="13"id="t5" size="20" required>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>Phone</span>
            </div>
            <div class="inputBox">
            <div>
                <input type="submit" value="Reset" name="submit">
            </div>
        </div>
        </div>
    </form>
</div>
</body>
</html>
<!-- The form -->