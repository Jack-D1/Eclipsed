<?php
include("scripts/validation/connection.php");
include("scripts/validation/check.php");
$searchTerm = $_GET['usersearch'];
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<link rel="stylesheet" href="default.css">';
echo '<div class = "topbar" position = "absolute">
			<a href="home.php"><img src="" alt="Eclipsed Logo"></a>
			<form action="searchusers.php" style = "display: inline-block;">
   				<input name = "usersearch" type="text" autocomplete="off" placeholder = "Search for users" required>
   				<input type="submit" name = "search" value = "search">
			</form>	
			<form method = "post" action = "/scripts/messaging/messaging.php" style="display: inline-block;">
				<input type = "text" name = "MessagingUser" placeholder = "Username of user to message" required>
				<input type = "submit" name = "submit" value = "Send Message">
			</form>
			<img src = "uploads/'.$_SESSION['UserID'].'.jpg"alt = "Profile Photo" class="myAccPic" style = "width: 25px; height: 25px; border-radius: 50%;">
			<a href = "'. $_SESSION['username'].'.php">My account</a>
			<a href = scripts/account/logout.php>Log Out</a> <br>
		</div>';
$searchTerm = mysqli_real_escape_string($connection, $searchTerm);
$search = "'%" . $searchTerm . "%'";
$getUsers = mysqli_query($connection, "SELECT username, displayname, UserID FROM user WHERE username LIKE $search OR displayname LIKE $search");
if(mysqli_num_rows($getUsers) > 0){
    
    $rowCount = 0;
    echo '<table class = "search" style = "margin-top: 70px;"><tr>';
    while($users = mysqli_fetch_assoc($getUsers)){
        $UAP = $users['username'] . ".php";
		$PF = "uploads/" . $users['UserID']. ".jpg";
        if ($rowCount < 5){
			echo '<td rowspan = "2"><img src = "'.$PF.'" alt = "Profile Photo" style = "width: 40px; height: 40px; border-radius: 50%;"></td>';
            echo '<td rowspan ="2">';
			echo '<a href ='. $UAP.' >';
            echo $users['displayname'];
			echo "<br>";
            echo $users['username'];
            echo "</td>";
            $rowCount++;
        }else{
            echo "</tr><tr></tr><tr>";
			echo '<td rowspan = "2"><img src = "'.$PF.'" alt = "Profile Photo" style = "width: 40px; height: 40px; border-radius: 50%;"></td>';
            echo '<td rowspan = "2">';
			echo '<a href ='. $UAP.' >';
            echo $users['displayname'];
			echo "<br>";
            echo $users['username'];
            echo "</td>";
            $rowCount = 1;
        }
    }
    echo "</tr></table>";
}else{
    echo '<div style = "margin-top: 70px;">No users found with that username or display name, check you have made no spelling mistakes and try again</div>';
}
mysqli_close($connection);
?>