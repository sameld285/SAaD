<?php 
session_start();
require_once("checkLogin.php");

$errorPassword = $erroremail = $invalidMesg = "";
$allfield = True;

if (isset($_POST['submit'])){
    if ($_POST['email'] == NULL){
        $erroremail = "Email is required";
        $allfield = FALSE;
    }
    if ($_POST['password']== NULL){
        $errorPassword = "Password is required";
        $allfield = FALSE;
    }
    if($_POST['email'] != null && $_POST["password"] !=null)
    {
        $array_user = verifyUsers(); 
        if ($array_user != null) {
            
            $_SESSION['userID'] = $array_user[0]['userID'];
            $_SESSION['fname'] = $array_user[0]['fname'];
            

            
            header("Location: userIndex.php"); 
            exit();
               
        }
        else{
            $invalidMesg = "Invalid username and password!";
        }
    }
}
include("navbar.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="body">
    
        <div class="box">
            <div class="signupFrm">
                <form method="post" class="form">
                <div class="question">Not a Member? <a href="signup.php">Sign up here</a></div>
                <h1 class="title">Login</h1>

                <div class="inputContainer">
                    
                    <input type="text" class="input" name="email" placeholder="a">
                    <label for="" class="label">Email</label>
                    <span class="error"><?php echo $erroremail; ?></span>

                </div>

                <div class="inputContainer">
                    <input type="password" class="input" name="password" placeholder="a">
                    <label for="" class="label">Password</label>
                    <span class="error"><?php echo $errorPassword; ?></span>

                </div>

                <div class="text">
                    <input class="submitBtn" type="submit" value="Login" name ="submit">
                    <span class="error"><?php echo $invalidMesg; ?></span>


                </div>
            </div>
            
            </div>

    </form>
</body>
</html>