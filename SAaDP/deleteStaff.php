<?php 
$db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');
$sql = "SELECT staffID, fname, lname, role FROM Staff WHERE staffID=:staffID";
$stmt = $db->prepare($sql);
$stmt->bindParam(':staffID', $_GET['staffID'], SQLITE3_TEXT);

$result= $stmt->execute();

while($row=$result->fetchArray(SQLITE3_NUM)){
    $arrayResult [] = $row;
}
if (isset($_POST['delete'])){

    $db = new SQLite3('C:\\Users\\Public\\data\\ComplaintSystem.db');

    $stmt = "DELETE FROM Staff WHERE staffID = :staffID";
    $sql = $db->prepare($stmt);
    $sql->bindParam(':staffID', $_POST['staffID'], SQLITE3_TEXT);

    $sql->execute();
    header("Location:viewStaff.php");
}

?>
    
<h2>Delete User, <?php echo $arrayResult[0][3];?></h2><br>
        <h4 style="color: red;">Are you sure want to delete this Member of Staff?</h4><br>
        
        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 20px; color:blue; font-weight: bold;">User ID</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][0] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label style="font-size: 20px; color:blue; font-weight: bold;">Complaint Subject</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][3] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
            <label style="font-size: 20px; color:blue; font-weight: bold;">Company Name</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][2] ?></label>
            </div>
        </div>

        

        <div class="row">
            <div class="col-5">
                <form method="post">
                     <input type="hIDden" name="ID" value = "<?php echo $_GET['ID'] ?>"><br>
                    <input type="submit" value="Delete" class="btn btn-danger" name="delete"><a href="viewStaff.php" style="font-weight: bold; padding-left: 30px;">Back</a>
                </form>
            </div>
        </div>

