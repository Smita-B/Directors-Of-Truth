<?php
include("config.php");
session_start();
// Define variables and initialize with empty values
    $username = $password = $chck_password = $REG_ID = "";
    $username_err = $password_err = "";
    $msg="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST["USERNAME"]))
            $username_err = "Username can only contain letters, numbers, and underscores.";
    else
        $username = $_POST["USERNAME"];
    $_SESSION['username']=$username;
    if(strlen($_POST["PASSWORD"]) < 6)
            $password_err = "Password must have atleast 6 characters.";
        else
            $password = $_POST["PASSWORD"];
    // Validate credentials
    if(empty($username_err) and empty($password_err))
    {
        $sanitized_userid = mysqli_real_escape_string($conn, $username);
      
        $sanitized_password = mysqli_real_escape_string($conn, $password);
        $sql=mysqli_query($conn,"select PASSWORD,A_ID from Admin_Details where Binary USERNAME='$sanitized_userid'");
        if($sql)
        {
            // Check if username exists, if yes then verify password
            if($sql->num_rows == 1)
            {
                while($row = $sql->fetch_assoc())
                {
                    $chck_password=$row["PASSWORD"];
                    $A_ID=$row["A_ID"];
                }
                if(strcmp($password,$chck_password)==0)
                {
                    header("location:admin dashboard.php");
                }
                else
                    $msg= "Invalid username or password<br>";
            }
             else
                            // Password is not valid, display a generic error message
                            $msg= "Invalid username or password<br>";
        }
          else
                    // Username doesn't exist, display a generic error message
                    $msg= "Invalid username or password<br>";
           }
}
// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login & Registration Page</title>
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

    </style>

</head>
<body>
    <div class="container">
        <form action='' method="POST">
        <div class="form signup">
            <h2>Admin Login</h2>
            <div class="inputBox">
                <input type="text" required="required" name="USERNAME">
                <i class="fa-regular fa-user"></i>
                <span>Username</span>
                <span class="error">
                    <center><?php echo $username_err; ?></center>
                </span>
            </div>
            <div class="inputBox">
                <input type="password" required="required" name="PASSWORD">
                <i class="fa-solid fa-lock"></i>
                <span>Create Password</span>
                <span class="error">
                    <center><?php echo $password_err; ?></center>
                </span>
            </div>
            <div class="inputBox">
                <input type="submit" value="Login">
            </div>
            <?php
                echo "<font color='yellow'>" . $msg . "</font>";
            ?>
        </div>
    </form>
</div>
</body>
</html>