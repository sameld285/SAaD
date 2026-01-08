<?php 
function verifyUsers () {

    if (!isset($_POST['email']) or !isset($_POST['password'])) {
        return null;
    }

    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');
    
    // Fetch user by email only (not password)
    $stmt = $db->prepare('SELECT userID, email, password, fname FROM Users WHERE email=:email');
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);
    
    // Verify the password hash
    if ($user && password_verify($_POST['password'], $user['password'])) {
        return [$user]; // Return user data if password matches
    }
    
    return null; // Invalid credentials
}
?>
