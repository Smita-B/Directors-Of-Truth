<?php

$msg = "";

include 'config.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_registration WHERE CODE='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) 
        {
            if(strlen($_POST["VP"]) < 6)
                $password_err = "Password must have atleast 6 characters.";
            else
                $password = $_POST["VP"];

            if(strlen($_POST["CP"]) < 6)
                $password_err = "Password must have atleast 6 characters.";
            else
                $confirm_password = $_POST["CP"];
            //$password = mysqli_real_escape_string($conn, md5($_POST['VP']));
            //$confirm_password = mysqli_real_escape_string($conn, md5($_POST['CP']));

            if ($password === $confirm_password) 
            {
                $query = mysqli_query($conn, "UPDATE user_registration SET PASSWORD='$password' WHERE CODE='{$_GET['reset']}'");

                if ($query) 
                {
                    header("Location: sign_in.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} 
else 
{
    header("Location: Forgot.php");
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="container">
        <form action='' method="POST">
        <div class="form signup">
            <h2>Reset Your Password</h2>
            <div class="inputBox">
                <input type="Password" required="required" name="VP">
                <i class="fa-solid fa-envelope"></i>
                <span>Password</span>
            </div>
            <div class="inputBox">
                <input type="Password" required="required" name="CP">
                <i class="fa-solid fa-envelope"></i>
                <span>Confirm Password</span>
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