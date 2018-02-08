<?php
include("../validation/connection.php");

if (isset($_POST['p_word'])){
    $options = [
        'cost' => 15,
    ];
    $Password = password_hash($_POST['p_word'], PASSWORD_BCRYPT, $options);
    $UserID = $_POST['user_id'];
    mysqli_query($connection, "UPDATE user SET password = '$Password' WHERE UserID = '$UserID'");
    exit();
}

?>