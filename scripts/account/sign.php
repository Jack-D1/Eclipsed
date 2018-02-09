<?php
include("../validation/connection.php");

$Username = $_POST['uName'];
$Password = $_POST['pWord'];
$Displayname = $_POST['dispName'];
session_start();


$Username = mysqli_real_escape_string($connection, $Username);
$Displayname = mysqli_real_escape_string($connection, $Displayname);

//Hashes and salts the users passwords 
$options = [
	'cost' => 15,
];
$Password = password_hash($Password, PASSWORD_BCRYPT, $options);

//Check if the user tries to register with an in use username and redirects them to the sign up page
$checkuser = mysqli_query($connection, "SELECT username FROM user WHERE username = '$Username'");

if (mysqli_num_rows($checkuser) == 1){  
	header('Location: signup.html');
}else{


	
	$addUser = mysqli_query($connection, "INSERT INTO user(username, displayname, password) VALUES ('$Username', '$Displayname', '$Password')");
	$getUserInfo = mysqli_query($connection, "SELECT * FROM user WHERE username = '$Username'");


	$queryResult = mysqli_fetch_assoc($getUserInfo);
	$UID = $queryResult['UserID'];

	//Creates a users profile page
	$file = "../../" . $Username . '.php';
	$fp = fopen($file, 'a');
	$fileContents = file_get_contents("UPD.txt");
	fwrite($fp, '<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	include("scripts/validation/connection.php");
	include("scripts/validation/check.php");
	$ThisID = ');
	fwrite($fp, $UID);
	fwrite($fp, $fileContents);
	fclose($fp);

	
	//Creates a users profile photo, the default one 
	$file = "../../uploads/". $UID. '.jpg';
	$fileContents = file_get_contents("../../uploads/default.jpg");
	$fp = fopen($file, 'a');
	fwrite($fp, $fileContents);
	fclose($fp);
	
	
	//Makes a user follow themselves so they can see their own posts on the home page 
	$showOwnPosts = mysqli_query($connection, "INSERT INTO following VALUES ('$UID', '$UID')");
	
	$user = $queryResult['username'];
	$_SESSION['UserID'] = $UID;
	$_SESSION['username'] = $user;
	mysqli_close($connection);
	header("Location: ../../home.php");
		

}		
?>