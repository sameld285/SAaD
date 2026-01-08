<?php require("navbar.php");?>
<style>
  .button {
    justify-content: center;
    display: block;
    margin-left: auto;
    padding: 12px 35px;
    border: none;
    background-color: purple;
    color: white;
    border-radius: 12px;
    cursor: pointer;
    font-size: 40px;
    margin-top: 100px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    text-decoration: none;

  }
  
  .button:hover {
    background-color: #9867C5;
    transform: translateY(-2px);
  }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">

    <title>Home</title>
</head>
<body>
    <div class="container">
        <p class="text-wrapper from-left">
            <a href="signup.php">
            <input class="button" type="submit" value="Create a Complaint" name =""></a>
        </p>
        <img class="image-wrapper" src="img/hsbc.jpg" alt="About Image">
    </div>
</body>
</html>