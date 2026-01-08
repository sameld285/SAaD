<?php
require("navbar.php");

// Connect to database
$db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

// Get all complaints
function getStaff($db) {
    $sql = "SELECT * FROM Staff";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $staff = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $staff[] = $row;
    }
    return $staff;
}



$staff = getStaff($db);
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
        <h2>View Staff</h2>

        <?php if (empty($staff)): ?>
            <p>There are currently no staff.</p>
        <?php else: ?>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Current Tasks</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
       <?php foreach ($staff as $staffMember): ?>
    <tr>
        <td><?= $staffMember['staffID']; ?></td>
        <td><?= $staffMember['fname']; ?></td>
        <td><?= $staffMember['lname']; ?></td>
        <td><?= $staffMember['role']; ?></td>
        <td><?= $staffMember['currentTask']; ?></td>
        <td><a href="deleteStaff.php?staffID=<?= $staffMember['staffID']; ?>">Delete</a></td>
    </tr>
<?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </main>
</div>

</body>
</html>
