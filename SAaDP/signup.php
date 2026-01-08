<?php
ob_start(); // Start output buffering
require("navbar.php");
include_once("createUser.php");
$errorfname = $errorlname = $erroremail = $errorpwd = "";
$allFields = "yes";

if (isset($_POST['submit'])){

    if ($_POST['fname']==""){
        $errorfname = "  First name is mandatory";
        $allFields = "no";
    }
    if ($_POST['lname']==""){
        $errorlname = "  Last name is mandatory";
        $allFields = "no";
    }
  
    if ($_POST['password']==""){
        $errorpwd = "  Password is mandatory";
        $allFields = "no";
    }
    if ($_POST['email']==""){
        $erroremail = "  Email is mandatory";
        $allFields = "no";
    }

    if($allFields == "yes")

{

    $createUser = createUser();

    header('Location:Success.php?createUser='.$createUser);

}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

</head>
<body class="body">
    
    <div class="box">
    <div class="signupFrm">
        <form method="post" class="form">
        <div class="question">
            Already a Member? <a href="login.php">Login here</a></div>
        <h1 class="title">Sign up</h1>

        <div class="inputContainer">
            <input type="text" class="input" name="fname" placeholder="a">
            <label class="label">First Name</label>
            <span class="error"><?php echo $errorfname; ?></span>

        </div>

        <div class="inputContainer">
            <input type="text" class="input" name="lname" placeholder="a">
            <label class="label">Last Name</label>
            <span class="error"><?php echo $errorlname; ?></span>

        </div>

        <div class="inputContainer">
            <input type="email" class="input" name="email" placeholder="a">
            <label class="label">Email</label>
            <span class="error"><?php echo $erroremail; ?></span>

        </div>

        <div class="inputContainer">
            <input type="password" class="input" name="password" placeholder="a">
            <label class="label">Password</label>
            <span class="error"><?php echo $errorpwd; ?></span>

        </div>

        <input type="submit" class="submitBtn" value="Sign up" name="submit">
        <div class="question"><a href="index.php">Home</a></div>

    </form>
  </div>
</body>
</html>

                   
                   


                   
