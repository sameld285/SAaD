<?php
session_start(); // start session at the top

// Include the complaint creation function
include("createComplaint.php");

// Make sure user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

$errorfname = $errorcname = $errorcomps = $errorcompd = "";
$allFields = "yes";

// Process form submission
if (isset($_POST['submit'])) {

    // Validation
    if ($_POST['cname'] == "") {
        $errorcname = "Please enter your company name";
        $allFields = "no";
    }
    if ($_POST['comps'] == "") {
        $errorcomps = "Please enter a subject";
        $allFields = "no";
    }
    if ($_POST['compd'] == "") {
        $errorcompd = "Please describe your complaint";
        $allFields = "no";
    }

    if ($allFields == "yes") {
        // Call function to create complaint
        $result = createComplaint($_SESSION['userID'], $_SESSION['fname'], $_SESSION['lname']);

        if ($result['created']) {
            $complaintID = $result['complaintID'];
            header('Location: Success.php?complaintID=' . $complaintID);
            exit();
        } else {
            echo "<p>Error creating complaint. Please try again.</p>";
        }
    }
}

// Include navbar AFTER processing headers
require("usernav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <div class="signupFrm">
        <form method="post" class="form">
            <div class="question">
                <h1 class="title">File Complaint</h1>
            </div>

            <!-- Name (prefilled from session) -->
            <div class="inputContainer">
                <input type="text" class="input" name="fname" 
                       value="<?php echo htmlspecialchars($_SESSION['fname']); ?>" 
                       readonly>
                <label class="label">Name</label>
            </div>

            <!-- Company Name -->
            <div class="inputContainer">
                <input type="text" class="input" name="cname" placeholder="Company Name" >
                <span class="error"><?php echo $errorcname; ?></span>
                <label class="label">Company name</label>
            </div>

            <!-- Complaint Subject -->
            <div class="inputContainer">
                <input type="text" class="input" name="comps" placeholder="Subject">
                <span class="error"><?php echo $errorcomps; ?></span>
                <label class="label">Subject</label>

            </div>

            <!-- Complaint Description -->
            <div class="inputContainer">
                <textarea class="input" name="compd" placeholder="Write your complaint here..."></textarea>
                <span class="error"><?php echo $errorcompd; ?></span>
                <label class="label">Description</label>

            </div>

            <!-- Submit -->
            <input type="submit" class="submitBtn" value="File Complaint" name="submit">
            <div class="question">
                <a href="userIndex.php">Home</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
