<?php
include ("connection.php");
if(isset($_POST['user_name'])){
	$name = $_POST['user_name'];
	$query = mysqli_query($connection, "SELECT username FROM user WHERE username = '$name'");
	
	if(mysqli_num_rows($query) > 0){
		echo 'Username already in use';
	}else{
		echo "OK";
	}
	exit();
}

?>