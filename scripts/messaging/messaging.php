<?php
include("/scripts/validation/check.php");
include("/scripts/validation/connection.php");

$MessagingUser = $_POST['MessagingUser'];


$getUserToMeassge = mysqli_query($connection, "SELECT * FROM user WHERE username = '$MessagingUser'");
if(mysqli_num_rows($getUserToMeassge) > 0){
$UserToMessage = mysqli_fetch_assoc($getUserToMeassge);

$_SESSION['UserSendTo'] = $UserToMessage['username'];
$_SESSION['UserSendToId'] = $UserToMessage['UserID'];
header("Location: index.php");
mysqli_close($connection);
}else{
	header("Location: home.php");
}
?>