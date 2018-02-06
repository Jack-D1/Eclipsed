<?php
	session_start();
	include("connection.php");
    $text = $_POST['text'];
	$UID = $_SESSION['UserID'];
	$text = mysqli_real_escape_string($connection, $text);
	$SendPost = mysqli_query($connection, "INSERT INTO post(postedBy, Post) VALUES ('$UID', '$text')");
	mysqli_close($connection);
?>