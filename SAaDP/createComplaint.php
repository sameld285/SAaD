<?php
function createComplaint($userID, $firstName, $lastName){
    $created = false;
    $complaintID = null;

    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

    // Combine first and last name
    $fullName = trim($firstName . ' ' . $lastName);

    // Insert complaint
    $sql = 'INSERT INTO Complaint(userID, fname, cname, comps, compd, progress) 
            VALUES (:userID, :fname, :cname, :comps, :compd, "unassigned")';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);
    $stmt->bindParam(':fname', $fullName, SQLITE3_TEXT);
    $stmt->bindParam(':cname', $_POST['cname'], SQLITE3_TEXT);
    $stmt->bindParam(':comps', $_POST['comps'], SQLITE3_TEXT);
    $stmt->bindParam(':compd', $_POST['compd'], SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        $created = true;
        $complaintID = $db->lastInsertRowID(); // get unique complaint ID
    }

    return ['created' => $created, 'complaintID' => $complaintID];
}
?>
