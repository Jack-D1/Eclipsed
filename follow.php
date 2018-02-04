<?php
include ("connection.php");
$action = $_POST['action'];
$follower = $_POST['follower'];
$user = $_POST['userID'];

if($action == "Follow"){
	mysqli_query($connection, "INSERT INTO following VALUES ('$follower', '$user')");
	exit();
}else{
	mysqli_query($connection, "DELETE from following WHERE UserID1 = '$follower' AND UserID2 = '$user'");
	exit();
}


?>