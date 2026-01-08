<?php require("navbar.php");?>
<style>
  .button {
    justify-content: center;
    display: block;
    margin-left: auto;
    padding: 12px 15px;
    border: none;
    background-color: purple;
    color: white;
    border-radius: 12px;
    cursor: pointer;
    font-size: 40px;
    margin-top: 100px;
    transition: transform 0.3s ease, background-color 0.3s ease;
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
            <a href="viewcomplaint.php">
            <input class="button" type="submit" value="View Complaint" name =""></a>
            <a href="staffcreator.php">
            <input class="button" type="submit" value="Create Staff" name =""></a>
            <a href="viewStaff.php">
            <input class="button" type="submit" value="View Staff" name =""></a>
        </p>
    </div>
</body>
</html>