<?php
		session_start();
		include("../validation/connection.php");
		

		//Gets the logged in users ID
		$UserID1 = $_SESSION['UserID'];
		//Gets the user to be messaged ID
		$UserID2 = $_SESSION['UserSendToId'];
		
		//Check if the messsaging ID exists when the logged in user's ID as the first ID in the table 
		$checkmessages = mysqli_query($connection, "SELECT * FROM messaging WHERE UserID1 = '$UserID1' AND UserID2 = '$UserID2' ");

		//Check if the messaging ID exists when the logged in user's ID is the second ID in the table
		$checkmessages2 = mysqli_query($connection, "SELECT * FROM messaging WHERE UserID1 = '$UserID2' AND UserID2 = '$UserID1' ");
		
		if(mysqli_num_rows($checkmessages) == 1){
			
			$messagearray = mysqli_fetch_assoc($checkmessages);
			$messagingID = $messagearray['MessagingID'];
			
		}elseif(mysqli_num_rows($checkmessages2) == 1){
			
			$messagearray = mysqli_fetch_assoc($checkmessages2);
			$messagingID = $messagearray['MessagingID'];
			
		}else{
			
			$addtotabe = mysqli_query($connection, "INSERT INTO messaging(UserID1, UserID2) VALUES ($UserID1, $UserID2)");
			$checkmessages = mysqli_query($connection, "SELECT * FROM messaging WHERE UserID1 = '$UserID1' AND UserID2 = '$UserID2'");
			$messagearray = mysqli_fetch_assoc($checkmessages);
			$messagingID = $messagearray['MessagingID'];
			
		}
		
		//Set the value of the message file to the messaging ID with .html  added on the end 
		$logfile = $messagingID . ".html";
		
		//Passes the name of the message file to the session variable file 
		$_SESSION['file'] = $logfile;
		
		//closes the sql connection 
		mysqli_close($connection);
?>