<?php 

// Connect to database
$db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

if (!isset($_GET['complaintID'])) {
    die("No complaint selected.");
}

$complaintId = $_GET['complaintID'];

$sql = "SELECT complaintID, fname, cname, comps, compd, progress FROM Complaint WHERE complaintID=:complaintID";
$stmt = $db->prepare($sql);
$stmt->bindValue(':complaintID', $complaintId, SQLITE3_TEXT);
$result = $stmt->execute();
$complaint = $result->fetchArray(SQLITE3_ASSOC);

if (!$complaint) {
    die("Complaint not found.");
}

if (isset($_GET['assign']) && isset($_GET['staffID'])) {

    $staffId = $_GET['staffID'];

    $stmtUpdate = $db->prepare("UPDATE Complaint SET progress='assigned' WHERE complaintID = :complaintID");
    $stmtUpdate->bindValue(':complaintID', $complaintId, SQLITE3_TEXT);
    $stmtUpdate->execute();

    $stmtInsert = $db->prepare("INSERT INTO Complaint_Staff (complaintID, staffID) VALUES (:complaintID, :staffID)");
    $stmtInsert->bindValue(':complaintID', $complaintId, SQLITE3_TEXT);
    $stmtInsert->bindValue(':staffID', $staffId, SQLITE3_TEXT);
    $stmtInsert->execute();

    $stmtTask = $db->prepare("UPDATE Staff SET currentTask = currentTask + 1 WHERE staffID = :staffID");
    $stmtTask->bindValue(':staffID', $staffId, SQLITE3_TEXT);
    $stmtTask->execute();

    header("Location:viewComplaint.php");
    exit;
}


// ---- GET STAFF LIST ----
function getStaff() {
    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');
    $sql = "SELECT * FROM Staff";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $staff = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $staff[] = $row;
    }

    return $staff;
}

$staffList = getStaff();
require("navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolve Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="table-wrapper">
    <main role="main">

        <h2>Resolve Complaint</h2>
        <h3 style="color: blue;">Allocate staff to resolve this issue</h3>

        <br>

        <!-- Complaint Details -->
        <div>
            <strong>User ID:</strong> <?= $complaint['complaintID']; ?><br>
            <strong>Customer Name:</strong> <?= $complaint['fname']; ?><br>
            <strong>Company:</strong> <?= $complaint['cname']; ?><br>
            <strong>Complaint Subject:</strong> <?= $complaint['comps']; ?><br>
            <strong>Complaint Details:</strong> <?= $complaint['compd']; ?><br>
            <strong>Status:</strong> <?= $complaint['progress']; ?><br>
        </div>

        <br><hr><br>

        <h3>Assign a Staff Member</h3>

        <?php if (empty($staffList)): ?>
            <p>No staff available.</p>
        <?php else: ?>

            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Current Tasks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($staffList as $staff): ?>
                    <tr>
                        <td><?= $staff['staffID']; ?></td>
                        <td><?= $staff['fname']; ?></td>
                        <td><?= $staff['lname']; ?></td>
                        <td><?= $staff['role']; ?></td>
                        <td><?= $staff['currentTask']; ?></td>

                        <!-- Assign staff (adds new row to junction table) -->
                        <td>
                            <a href="resolve.php?complaintID=<?= $complaintId ?>&staffID=<?= $staff['staffID'] ?>&assign=1">
                                Assign
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>

        <?php endif; ?>

        <br><br>
        <a href="viewComplaint.php" style="font-weight:bold;">Back</a>

    </main>
</div>

</body>
</html>
