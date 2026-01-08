<?php

function createUser(){

    $created = false;
    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');
    $sql = 'INSERT INTO Users(fname, lname, email, password) VALUES (:fname, :lname, :email, :password)';
    $stmt = $db->prepare($sql); 

// Hash the password before storing it
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Store $hashedPassword in the database to keep the data encrypted
$db = new SQLite3('C:\\Users\\Public\\data\\COmplaintSystem.db');
$stmt = $db->prepare('INSERT INTO Users (email, password, fname, lname) VALUES (:email, :password, :fname, :lname)');
$stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
$stmt->bindParam(':password', $hashedPassword, SQLITE3_TEXT);
$stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
$stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
$stmt->execute();

    //the logic
    if($stmt){
        $created = true;
    }

    return $created;
}
