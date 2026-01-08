<?php

function createStaff(){

    $created = false;//this variable is used to indicate the creation is successfull or not
    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = 'INSERT INTO Staff(fname, lname, role, currentTask) VALUES (:fname, :lname, :role, 0)';
    $stmt = $db->prepare($sql); //prepare the sql statement

    //give the values for the parameters
    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':role', $_POST['role'], SQLITE3_TEXT);


    //execute the sql statement
    $stmt->execute();

    //the logic
    if($stmt){
        $created = true;
    }

    return $created;
}
