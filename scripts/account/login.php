<html>
	<head>
		<link rel="stylesheet" href="../../default.css">
	</head>
</html>

<?php
session_start();
include("../validation/connection.php");

$Username = $_POST['uName'];
$Password = $_POST['pWord'];

$accountexists = "";
$accNotFound = 'Your account does not exist <br> <a href = "../../index.html">Click here to try again</a><br> <a href = "../../signup.html">Click here to sign up</a>';

$Username = mysqli_real_escape_string($connection, $Username);


$CheckAccount = mysqli_query($connection, "SELECT * FROM user WHERE username = '$Username'");
if(mysqli_num_rows($CheckAccount) != 1){
	
		echo $accNotFound;
		
}else{
	$queryResult = mysqli_fetch_assoc($CheckAccount);
	if(password_verify($Password, $queryResult['password'])){
			$_SESSION['UserID'] = $queryResult['UserID'];
			$_SESSION['username'] = $queryResult['username'];
			$accountexists = "TRUE";
			
	}else{
		echo $accNotFound;
	}
}
mysqli_close($connection);
if ($accountexists == "TRUE"){
	header('Location: ../../home.php');
}
?>