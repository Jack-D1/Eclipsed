<html>
	<head>
		<link rel="stylesheet" href="default.css">
	</head>
</html>

<?php
session_start();
include("connection.php");

$Username = $_POST['uName'];
$Password = $_POST['pWord'];

$accountexists = "";
$accNotFound = 'Your account does not exist <br> <a href = "index.html">Click here to try again</a><br> <a href = "signup.html">Click here to sign up</a>';

$Username = mysqli_real_escape_string($connection, $Username);


$CheckAccount = mysqli_query($connection, "SELECT * FROM user WHERE username = '$Username'");
if(mysqli_num_rows($CheckAccount) != 1){
	
		echo $accNotFound;
		
}else{
	$queryResult = mysqli_fetch_assoc($CheckAccount);
	if(password_verify($Password, $queryResult['password'])){
			mysqli_close($connection);
			$user = $queryResult['username'];
			$_SESSION['UserID'] = $queryResult['UserID'];
			$_SESSION['username'] = $user;
			$accountexists = "TRUE";
			
	}else{
		echo $accNotFound;
	}
}

if ($accountexists == "TRUE"){
	header('Location: home.php');
}
?>