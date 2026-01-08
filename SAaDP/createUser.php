<?php

function createUser(){

    $created = false;//this variable is used to indicate the creation is successfull or not
    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = 'INSERT INTO Users(fname, lname, email, password) VALUES (:fname, :lname, :email, :password)';
    $stmt = $db->prepare($sql); //prepare the sql statement

// Hash the password before storing it
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Store $hashedPassword in the database
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
