<?php
include("createstaff.php");
$errorfname = $errorcname = $errorcomps = $errorcompd = "";
$allFields = "yes";

if (isset($_POST['submit'])){

    if ($_POST['fname']==""){
        $errorfname = "  Please enter your name";
        $allFields = "no";
    }
    if ($_POST['lname']==""){
        $errorcname = "  Please enter your company name";
        $allFields = "no";
    }
  
    if ($_POST['role']==""){
        $errorcomps = "  Please enter a subject";
        $allFields = "no";
    }


    if($allFields == "yes")

{

    $createStaff = createStaff();

    header('Location: Success.php?createStaff='.$createStaff);

}
}
require("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff</title>
</head>
<body>
    <body class="body">
 <div class="box">
  <div class="signupFrm">
    <form method="post" class="form">
      <div class="question">
        <h1 class="title">Create Staff</h1>
      </div>

      <!-- Left side inputs -->
      <div class="inputRow">
        <div class="leftInputs">
          <div class="inputContainer">
            <input type="text" class="input" name="fname" placeholder="a">
            <label class="label">First Name</label>
            <span class="error"><?php echo $errorfname; ?></span>
          </div>

          <div class="inputContainer">
            <input type="text" class="input" name="lname" placeholder="a">
            <label class="label">Last Name</label>
            <span class="error"><?php echo $errorcname; ?></span>
          </div>

          <div class="inputContainer">
            <input type="text" class="input" name="role" placeholder="a">
            <label class="label">Role</label>
            <span class="error"><?php echo $errorcomps; ?></span>
          </div>
        </div>


      <!-- Submit -->
      <input type="submit" class="submitBtn" value="Create" name="submit">

    </form>
  </div>
</div>
