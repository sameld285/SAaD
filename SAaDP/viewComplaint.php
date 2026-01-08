<?php
require("navbar.php");

// Connect to database
$db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

// Get all complaints
function getComplaints($db) {
    $sql = "SELECT * FROM Complaint";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $complaints = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $complaints[] = $row;
    }
    return $complaints;
}

// Get all staff assigned to a complaint
function getAssignedStaff($db, $complaintID) {
    $sql = "SELECT Staff.fname, Staff.lname
            FROM Staff
            JOIN Complaint_Staff ON Staff.staffID = Complaint_Staff.staffID
            WHERE Complaint_Staff.complaintID = :complaintID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':complaintID', $complaintID, SQLITE3_TEXT);
    $result = $stmt->execute();

    $staff = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $staff[] = $row['fname'] . ' ' . $row['lname'];
    }
    return $staff;
}

$complaints = getComplaints($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="table-wrapper">
    <main role="main">
        <h2>View Complaints</h2>

        <?php if (empty($complaints)): ?>
            <p>There are currently no complaints.</p>
        <?php else: ?>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Subject</th>
                        <th>Details</th>
                        <th>Progress</th>
                        <th>Assigned Staff</th>
                        <th>Resolve</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($complaints as $complaint): ?>
                    <?php 
                        $assignedStaff = getAssignedStaff($db, $complaint['complaintID']);
                        $assignedText = !empty($assignedStaff) ? implode(', ', $assignedStaff) : 'None';
                    ?>
                    <tr>
                        <td><?= $complaint['complaintID']; ?></td>
                        <td><?= $complaint['fname']; ?></td>
                        <td><?= $complaint['cname']; ?></td>
                        <td><?= $complaint['comps']; ?></td>
                        <td><?= $complaint['compd']; ?></td>
                        <td><?= $complaint['progress']; ?></td>
                        <td><?= $assignedText; ?></td>
                        <td><a href="resolve.php?complaintID=<?= $complaint['complaintID']; ?>">Resolve</a></td>
                        <td><a href="deleteComplaint.php?complaintID=<?= $complaint['complaintID']; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </main>
</div>

</body>
</html>
