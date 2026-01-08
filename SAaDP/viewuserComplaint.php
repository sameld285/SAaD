<?php
session_start(); // Start session


// Make sure user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

$userID = $_SESSION['userID'];

// Connect to database
$db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

// Get complaints for the current user only
function getComplaints($db, $userID) {
    $sql = "SELECT cname, compd, progress FROM Complaint WHERE userID = :userID ORDER BY complaintID DESC";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $complaints = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $complaints[] = $row;
    }
    return $complaints;
}

// Fetch complaints for logged-in user
$complaints = getComplaints($db, $userID);
require("usernav.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="table-wrapper">
    <main role="main">
        <h2>My Complaints</h2>

        <?php if (empty($complaints)): ?>
            <p>You have not filed any complaints yet.</p>
        <?php else: ?>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Complaint Name</th>
                        <th>Description</th>
                        <th>progress</th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach ($complaints as $complaint): ?>
                    <tr>
                        <td><?= htmlspecialchars($complaint['cname']); ?></td>
                        <td><?= htmlspecialchars($complaint['compd']); ?></td>
                        <td><?= htmlspecialchars($complaint['progress']); ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
