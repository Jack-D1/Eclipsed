<?php
	session_start();
	include("../validation/connection.php");
    $text = $_POST['text'];
	$UID = $_SESSION['UserID'];
	$text = mysqli_real_escape_string($connection, $text);
	$text = htmlspecialchars($text);
	$SendPost = mysqli_query($connection, "INSERT INTO post(postedBy, Post) VALUES ('$UID', '$text')");
	mysqli_close($connection);
?>