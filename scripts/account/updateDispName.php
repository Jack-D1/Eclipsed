<?php
include("../validation/connection.php");

if (isset($_POST['disp_name'])){
    $name = $_POST['disp_name'];
    $ID = $_POST['user_id'];
    mysqli_query($connection,"UPDATE user SET displayname = '$name' WHERE UserID = '$ID'");
    exit();
}

?>