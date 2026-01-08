<?php
session_start(); // start session before any output
require("usernav.php"); // make sure this file has NO whitespace before <?php
include("session.php");

$path = "login.php"; // path for redirect

// Check if user is logged in
if (!isset($_SESSION['userID'])){
    session_unset();
    session_destroy();
    header("Location:".$path);
    exit(); // stop execution after redirect
}

$id = $_SESSION['userID'];
$name = isset($_SESSION['fname']) ? $_SESSION['fname'] : "User";

checkSession($path); // calling the function from session.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome, <?php echo $name?></h1>
</body>
</html>       


                   
