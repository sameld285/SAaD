<?php

function createStaff(){

    $created = false;
    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db'); 
    $sql = 'INSERT INTO Staff(fname, lname, role, currentTask) VALUES (:fname, :lname, :role, 0)';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':role', $_POST['role'], SQLITE3_TEXT);


    $stmt->execute();

    if($stmt){
        $created = true;
    }

    return $created;
}
